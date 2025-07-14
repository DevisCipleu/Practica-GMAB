<?php

require_once('../model/Department.php');

if (!empty($_POST)) {
    $department = new Department();
    $succes = $department->UpdateDepartments($_POST);

    if ($succes == true) {
        echo json_encode(array("success" => 1));
    } else {
        $id = $succes;
        echo json_encode(array("success" => 0, "error" => "Failed to update department with id: $id"));
    }
} else {
    echo json_encode(array("success" => 0, "error" => "No department data received."));
}
