<?php
session_start();
include("model/Database.php");
$database = new Database();
$conn = $database->GetConnection();

if (isset($_SESSION['utilizator'])) {
    $sql = "SELECT id , department_name FROM departments";
    $result = mysqli_query($conn, $sql);
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
        <title>Departments Update</title>

        </script>
    </head>

    <body>

        <div class="spinner-wrapper">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

    <?php
    if (mysqli_num_rows($result) > 0) {

        echo '<div class="container d-flex min-vh-100 justify-content-center align-items-center">
                    <form id="update-departments-form" method="post">
                    <div class="mb-3"><h2>Update Departments</h2></div>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='mb-3'>
                        <label for='{$row['id']}' class='form-label'>Department Name</label>
                        <input type='text' class='form-control' id='{$row['id']}' name='{$row['id']}' value='{$row['department_name']}'>
                    </div>";
        }

        echo "<button type='submit' class='btn btn-primary' id='update-department-button'>Submit</button>";
    } else {
        echo "No departments found!";
    }
} else {
    echo "Invalid Request!";
}

    ?>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
        integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="scripts/departments_update_scripts.js"></script>
    </body>

    </html>