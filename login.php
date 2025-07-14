<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Log in</title>
</head>

<body>

    <div class="spinner-wrapper">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="container d-flex min-vh-100 justify-content-center align-items-center">
        <form id="login-form" method="post">
            <div class="mb-3">
                <label for="loginusername" class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="Enter Username" id="loginusername"
                    name="loginusername" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="loginpassword" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter Password" id="loginpassword" name="loginpassword">
            </div>
            
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" id="loginbutton">Log In</button>
            </div>
            <div class="mb-1">
                <p>You don't have an account?</p>
            </div>
            <button type="submit" class="btn btn-primary" id="registerbutton">Register</button>
            

        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
        integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="scripts/login_script.js"></script>
</body>

</html>