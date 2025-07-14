<?php

require_once('Database.php');

class Department
{
    public $conn;
    public $database;

    public function __construct()
    {
        $this->database = new Database();
        $this->conn = $this->database->GetConnection();
    }

    public function __destruct()
    {
        $this->conn = $this->database->EndConnection();
    }

    public function UpdateDepartments($departments)
    {
        foreach ($departments as $id => $name) {

            $sql = "UPDATE departments SET department_name = '$name' WHERE id = '$id'";
            $result = mysqli_query($this->conn, $sql);

            if (!$result) {
                return $id;
            }
        }
        return true;
    }
}
