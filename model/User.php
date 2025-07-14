<?php
require_once('Database.php');

class User
{
    public $database;
    public $conn;

    public function __construct()
    {
        $this->database = new Database();
        $this->conn = $this->database->GetConnection();
        session_start();
    }

    public function __destruct()
    {
        $this->conn = $this->database->EndConnection();
    }

    public function Login($username, $password)
    {
        $select = "SELECT username, password, id FROM users";
        $result = mysqli_query($this->conn, $select);
        $matchFound = false;

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($username == $row['username'] && $password == $row['password']) {
                    $_SESSION['utilizator'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $matchFound = true;
                    break;
                }
            }
        }

        return $matchFound;
    }

    public function Registration($fname, $lname, $department, $uname, $pass, $email, $contact, $profilePic)
    {
        $select = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($this->conn, $select);

        if (mysqli_num_rows($result) > 0) {
            return 1;
        }


        $sql = "SELECT id FROM departments WHERE department_name = '$department'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $dep_id = $row['id'];


        $photoPath = null;


        if ($profilePic && $profilePic['error'] === UPLOAD_ERR_OK) {
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $mimeType = mime_content_type($profilePic['tmp_name']);

            if (!in_array($mimeType, $allowedMimeTypes)) {
                return 0;
            }

            $uploadDir = '../ProfilePic/';
            $publicPath = 'ProfilePic/';
            $ext = pathinfo($profilePic['name'], PATHINFO_EXTENSION);
            $filename = $fname . "_" . $lname . "." . $ext;
            $targetPath = $uploadDir . $filename;

            if (move_uploaded_file($profilePic['tmp_name'], $targetPath)) {
                $photoPath = $publicPath . $filename;
            } else {
                return 0;
            }
        }


        $sql = "INSERT INTO users (first_name, last_name, department_id, username, password, email, phone, photo) 
                VALUES ('$fname', '$lname', '$dep_id', '$uname', '$pass', '$email', '$contact', '$photoPath')";

        $query = mysqli_query($this->conn, $sql);

        if ($query) {
            return 2;
        }

        return 0;
    }

    public function UpdateUser($user_id, $first_name, $last_name, $department, $username, $email, $profilePic)
    {

        $photoPath = null;
        if ($profilePic && $profilePic['error'] === UPLOAD_ERR_OK) {
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $mimeType = mime_content_type($profilePic['tmp_name']);

            if (!in_array($mimeType, $allowedMimeTypes)) {
                return 0;
            }

            $uploadDir = '../ProfilePic/';
            $publicPath = 'ProfilePic/';
            $ext = pathinfo($profilePic['name'], PATHINFO_EXTENSION);
            $filename = $first_name . "_" . $last_name . "." . $ext;
            $targetPath = $uploadDir . $filename;

            if (move_uploaded_file($profilePic['tmp_name'], $targetPath)) {
                $photoPath = $publicPath . $filename;
            } else {
                return 0;
            }
        }


        $sql = "SELECT id from departments where department_name = '$department'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $dep_id = $row['id'];

        $sql = "UPDATE users SET first_name = '$first_name' , last_name = '$last_name' , 
                department_id = '$dep_id' , username = '$username' , email = '$email', photo = '$photoPath' WHERE id = '$user_id' ";

        if (mysqli_query($this->conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function PromoteUser($user_id)
    {
        $sql = "UPDATE users SET admin = 1 WHERE id = '$user_id'";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function DemoteUser($user_id)
    {
        $sql = "UPDATE users SET admin = 0 where id = '$user_id'";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function DeleteUser($user_id)
    {
        $sql = "DELETE from users where id = '$user_id'";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
}
