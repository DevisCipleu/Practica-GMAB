<?php

session_start();
include("model/Database.php");
$database = new Database();
$conn = $database->GetConnection();


if (isset($_SESSION['utilizator']) && isset($_GET['user_id'])) {

    $user_id = $_GET['user_id'];
    $sql = "SELECT u.first_name, u.last_name, d.department_name AS department, u.username, u.email
                FROM users u
                JOIN departments d ON u.department_id = d.id
                WHERE u.id = '$user_id'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);
    } else {
        echo "No record found about this user!";
    }
} else {
    echo "Unauthorized or Invalid Request!";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Update Form</title>
</head>

<body>


    <div class="spinner-wrapper">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="d-flex min-vh-100 justify-content-center align-items-center">
        <form id="user_update_form" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <h2>User Update Form</h2>
            </div>

            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

            <div class="mb-3">
                <label for="u_firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="u_firstname" name="u_firstname" value="<?php echo $user['first_name']; ?>">
            </div>

            <div class="mb-3">
                <label for="u_lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="u_lastname" name="u_lastname" value="<?php echo $user['last_name'] ?>">
            </div>

            <?php
            $departmentsQuery = "SELECT department_name FROM departments ORDER BY department_name ASC";
            $departmentsResult = mysqli_query($conn, $departmentsQuery);

            ?>


            <div class="mb-3">
                <label for="u_department" class="form-label">department</label>
                <select class="form-control" id="u_department" name="u_department">
                    <?php
                    while ($row = mysqli_fetch_assoc($departmentsResult)): ?>
                        <option value="<?php echo htmlspecialchars($row['department_name']); ?>"
                            <?php echo ($user['department'] == $row['department_name']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row['department_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="u_username" class="form-label">Username</label>
                <input type="text" class="form-control" id="u_username" name="u_username" value="<?php echo $user['username']; ?>">
            </div>

            <div class="mb-3">
                <label for="u_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="u_email" name="u_email" aria-describedby="emailHelp" value="<?php echo $user['email']; ?>">
            </div>

            <div class="mb-3">
                <label for="profile-pic" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="profile-pic" name="profile-pic">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
        integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="scripts/update_user_script.js"></script>

</body>

</html>