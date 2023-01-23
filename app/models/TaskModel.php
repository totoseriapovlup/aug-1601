<?php

namespace app\models;

use mysqli;

class TaskModel
{
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
        $sql = "INSERT INTO tasks (name) VALUES ('{$task['name']}');";
        $result = $this->db->query($sql);
        if (!$result) {
            //TODO create log
            exit('some problem with insert task');
        }
    }

    public function all()
    {
        $sql = "SELECT * FROM tasks;";//TODO think about ordering
        $result = $this->db->query($sql);
        if (!$result) {
            //TODO create log
            exit('some problem with select task');
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM tasks where id = $id;";
        $result = $this->db->query($sql);
        if (!$result) {
            //TODO create log
            exit('some problem with delete task');
        }
    }

}