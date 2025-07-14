<?php

    session_start();
    include("database.php");


    if (isset($_SESSION['utilizator'])) {
        if (!empty($_POST)) {
            foreach ($_POST as $id => $name) {
                
                $sql = "UPDATE departments SET department_name = '$name' WHERE id = '$id'";
                $result = mysqli_query($conn, $sql);
    
                if (!$result) {
                    echo json_encode(array("success" => 0, "error" => "Failed to update department with ID: $id"));
                    exit; 
                }
            }
    
            
            echo json_encode(array("success" => 1));
        } else {
            echo json_encode(array("success" => 0, "error" => "No department data received."));
        }
    } else {
        echo json_encode(array("success" => 0, "error" => "Invalid Request!"));
    }

?>
