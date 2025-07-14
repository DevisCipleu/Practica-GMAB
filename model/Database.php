<?php

class Database
{
    public $servername;
    public $username;
    public $password;
    public $db_name;
    public $conn;

    public function __construct()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->db_name = "website";
    }

    public function GetConnection()
    {
        try {
            $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->db_name);
            return $this->conn;
        } catch (mysqli_sql_exception) {
            echo "Could not connect!";
        }
    }

    public function EndConnection()
    {
        mysqli_close($this->conn);
    }
}
