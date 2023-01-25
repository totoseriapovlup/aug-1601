<?php

namespace app\models;

use mysqli;

class TaskModel
{
    protected $table = 'tasks';
    /**
     * @var mysqli
     */
    protected mysqli $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_errno != 0) {
            //TODO create log
            exit('mysql gone away, try later');
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