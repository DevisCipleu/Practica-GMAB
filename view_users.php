<?php

session_start();
include("model/Database.php");
$database = new Database();
$conn = $database->GetConnection();

if (isset($_SESSION['utilizator'])) {
  $logged_user = $_SESSION['utilizator'];
  $sql = "SELECT admin from users where id = '$logged_user'";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $isAdmin = $row['admin'];
}





if (isset($_SESSION['utilizator'])) {

  $sql = "SELECT u.first_name , u.id , u.last_name , d.department_name AS department , u.username , u.email , u.admin , u.photo
            from users u
            join departments d ON u.department_id = d.id
            order by u.first_name";
  $result = mysqli_query($conn, $sql);
  $admin = 1;



  if (mysqli_num_rows($result) > 0) {
    echo '<div class="d-flex min-vh-100 justify-content-center align-items-center">
      <div>

        <div class="d-flex align-items-center justify-content-center search-bar gap-4">
              <input class="form-control me-2 search-user" id="search-user" type="search" placeholder="Search user..." aria-label="Search">

              <select class="form-select search-user" id="search-user-select" aria-label="Default select example">
                <option disabled selected>Search user by department</option>';
    $departmentsQuery = "SELECT department_name FROM departments";
    $departmentsResult = mysqli_query($conn, $departmentsQuery);
    while ($row = mysqli_fetch_assoc($departmentsResult)) {
      $dept = htmlspecialchars($row['department_name']);
      echo "<option value=\"$dept\">$dept</option>";
    }
    echo ' </select>

        </div>

      <h2>List of other users</h2>';

    echo "<table id='users_table'>
                <thead><tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Department</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Photo</th>";
    if ($isAdmin) {
      echo "<th>Actions</th>";
    }
    echo "</tr></thead>";


    while ($row = mysqli_fetch_assoc($result)) {
      if ($_SESSION['utilizator'] == $row['id']) {
        continue;
      } else if ($row['admin'] == $admin) {
        echo "<tbody><tr>
                    <td>{$row['first_name']}</td>
                    <td>{$row['last_name']}</td>
                    <td>{$row['department']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td><img src='{$row['photo']}' class='profile-pic' alt='Profile Picture'></td>";

        if ($isAdmin) {
          echo "<td>
                            <button type='button' class='btn btn-success update-button' data-id = {$row['id']} >Update</button> 
                            <button type='button' class='btn btn-danger delete-button' data-id = {$row['id']} >Delete</button>
                            <button type='button' class='btn btn-warning demote-button' data-id = {$row['id']} >Demote</button> </td>";
        }

        echo  "</tr>";
      } else {
        echo "<tr>
                    <td>{$row['first_name']}</td>
                    <td>{$row['last_name']}</td>
                    <td>{$row['department']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td><img src='{$row['photo']}' class='profile-pic' alt='Profile Picture'></td>";

        if ($isAdmin) {
          echo "<td>
                            <button type='button' class='btn btn-success update-button' data-id = {$row['id']} >Update</button> 
                            <button type='button' class='btn btn-danger delete-button' data-id = {$row['id']} >Delete</button>
                            <button type='button' class='btn btn-primary promote-button' data-id = {$row['id']} >Promote</button> </td>";
        }

        echo  "</tr></tbody>";
      }
    }

    echo "</table></div>
        </div>";
  } else {
    echo '<h2>No users found!!</h2>';
  }
} else {
  header('Location: login.php');
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <title>Users table</title>
</head>

<body>

  <div class="spinner-wrapper">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script src="scripts/users_table_scripts.js"></script>
</body>

</html>