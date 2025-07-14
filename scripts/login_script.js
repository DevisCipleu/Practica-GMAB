$(document).ready(function () {
    $(".spinner-wrapper").delay(500).fadeOut("slow");
    $("#login-form").validate({
        rules: {

            loginusername: {
                required: true,
                minlength: 10,
                maxlength: 20
            },

            loginpassword: {
                required: true,
                minlength: 5
            }
        },
        highlight: function (element) {
            $(element).removeClass('correct-border');
            $(element).addClass('error-border');
        }, unhighlight: function (element) {
            $(element).removeClass('error-border');
            $(element).addClass('correct-border');
        }

    });

    $("#loginbutton").click(function (event) {
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: 'controller/UserController.php',
            data: {
                lusername: $("#loginusername").val(),
                lpassword: $("#loginpassword").val(),
                processing: 1
            },
            success: function (response) {
                var jsonData = JSON.parse(response);

                // user is logged in successfully in the back-end 
                // let's redirect 
                if (jsonData.success == "1") {
                    location.href = "index.php";
                } else if (jsonData.success == "2") {
                    alert('Invalid Username or Password!');
                }
                else {
                    alert('Unable to process the login verification!');
                }
            }
        });


    });

    $("#registerbutton").click(function (event) {
        event.preventDefault();
        location.href = "registration_form.php";
    })
});    