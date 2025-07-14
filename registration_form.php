<?php
require_once('model/Department.php');
$database = new Database();
$conn = $database->GetConnection();
$departmentsQuery = "SELECT department_name FROM departments ORDER BY department_name ASC";
$departmentsResult = mysqli_query($conn, $departmentsQuery);
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Registration Form</title>
</head>

<body>



  <div class="spinner-wrapper">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>


  <div class="d-flex min-vh-100 justify-content-center align-items-center" id="contact-section">
    <form id="registration" method="post" enctype="multipart/form-data">
      <div class="container text-center ">
        <div class="d-flex align-items-center justify-content-center gap-4">
          <div class="label-spacing">
            <label for="firstname" class="form-label labels"><b>First Name</b></label>
          </div>

          <div>
            <div class="input-group mb-3 ">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user p-1"
                    aria-hidden="true"></i></span>
              </div>
              <input type="text" placeholder="First Name" class="form-control" id="firstname" name="firstname">
            </div>
          </div>
        </div>
      </div>


      <div class="container text-center">
        <div class="d-flex align-items-center justify-content-center gap-4">
          <div class="label-spacing">
            <label for="lastname" class="form-label labels"><b>Last Name</b></label>
          </div>

          <div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user p-1"
                    aria-hidden="true"></i></span>
              </div>
              <input type="text" placeholder="Last Name" class="form-control" id="lastname" name="lastname">
            </div>
          </div>
        </div>
      </div>

      <div class="container text-center">
        <div class="d-flex align-items-center justify-content-center gap-4">
          <div class="label-spacing">
            <label for="departments" class="form-label labels"><b>Department / Office</b></label>
          </div>

          <div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-list p-1"
                    aria-hidden="true"></i></span>
              </div>

              <select class="form-control" id="departments" name="departments" required>
                <option value="" disabled selected>Select your Department...</option>
                <?php
                while ($row = mysqli_fetch_assoc($departmentsResult)) {
                  $dept = htmlspecialchars($row['department_name']);
                  echo "<option value=\"$dept\">$dept</option>";
                }
                ?>
              </select>
              <!--
              <select class="form-control" id="departments" name="departments">
                <option value="" disabled selected>Select your Department...</option>
                <option value="Finance">Finance</option>
                <option value="Marketing">Marketing</option>
                <option value="IT">IT</option>
                <option value="Human Resources">Human Resources</option>
              </select>
              -->
            </div>
          </div>
        </div>
      </div>


      <div class="container text-center">
        <div class="d-flex align-items-center justify-content-center gap-4">
          <div class="label-spacing">
            <label for="username" class="form-label labels"><b>Username</b></label>
          </div>

          <div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user p-1"
                    aria-hidden="true"></i></span>
              </div>
              <input type="text" placeholder="Username" class="form-control" id="username" name="username">
            </div>
          </div>
        </div>
      </div>


      <div class="container text-center">
        <div class="d-flex align-items-center justify-content-center gap-4">
          <div class="label-spacing">
            <label for="password" class="form-label labels"><b>Password</b></label>
          </div>

          <div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user p-1"
                    aria-hidden="true"></i></span>
              </div>
              <input type="password" placeholder="Password" class="form-control" id="password" name="password">
            </div>
          </div>
        </div>
      </div>


      <div class="container text-center">
        <div class="d-flex align-items-center justify-content-center gap-4">
          <div class="label-spacing">
            <label for="cpassword" class="form-label labels"><b>Confirm Password</b></label>
          </div>

          <div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user p-1"
                    aria-hidden="true"></i></span>
              </div>
              <input type="password" placeholder="Confirm Password" class="form-control" id="cpassword"
                name="cpassword">
            </div>
          </div>
        </div>
      </div>


      <div class="container text-center">
        <div class="d-flex align-items-center justify-content-center gap-4">
          <div class="label-spacing">
            <label for="email" class="form-label labels"><b>E-mail</b></label>
          </div>

          <div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope p-1"
                    aria-hidden="true"></i></span>
              </div>
              <input type="email" placeholder="E-mail Address" class="form-control" id="email" name="email">
            </div>
          </div>
        </div>
      </div>


      <div class="container text-center">
        <div class="d-flex align-items-center justify-content-center gap-4">
          <div class="label-spacing">
            <label for="contact" class="form-label labels"><b>Contact No.</b></label>
          </div>

          <div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user p-1"
                    aria-hidden="true"></i></span>
              </div>
              <input type="tel" class="form-control" placeholder="(639)" id="contact" name="contact" required>
            </div>
          </div>
        </div>
      </div>


      <div class="container text-center">
        <div class="d-flex align-items-center justify-content-center gap-4">
          <div class="label-spacing">
            <label for="contact" class="form-label labels"><b>Profile Picture</b></label>
          </div>

          <div>
            <div class="input-group mb-3">
              <input type="file" class="form-control" id="profile-pic" name="profile-pic">
            </div>
          </div>
        </div>
      </div>

      <div class="container text-center">
        <div class="d-flex align-items-center justify-content-center gap-4">
          <div>
            <button type="submit" class="btn btn-primary" id="submitButton">Register <i class="fa fa-paper-plane"
                aria-hidden="true"></i></button>
          </div>
        </div>
      </div>
    </form>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
    integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="scripts/registration_scripts.js"></script>

</body>

</html>