<?php

namespace app\models;

use app\core\DBException;
use mysqli;

class TaskModel
{
    protected $table = 'tasks';
    /**
     * @var mysqli
     */
    protected mysqli $db;

    /**
     * TaskModel constructor.
     * @throws DBException
     */
    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_errno != 0) {
            throw new DBException($this->db->connect_error);
        }
    }

    public function add(array $task)
    {
        $sql = "INSERT INTO {$this->table} (name) VALUES ('{$task['name']}');";
        $result = $this->db->query($sql);
        if (!$result) {
            //TODO create log
            exit('some problem with insert task');
        }
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->table};";//TODO think about ordering
        $result = $this->db->query($sql);
        if (!$result) {
            //TODO create log
            exit($this->db->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM {$this->table} where id = $id;";
        $result = $this->db->query($sql);
        if (!$result) {
            //TODO create log
            exit('some problem with delete task');
        }
    }

}