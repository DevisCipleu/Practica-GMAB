$(document).ready(function () {
    $(".spinner-wrapper").delay(500).fadeOut("slow");
    var savedScrollPos = localStorage.getItem('scrollPos');

    if (savedScrollPos) {
        // Restore the scroll position if it exists
        $(window).scrollTop(savedScrollPos);

        // Remove the scroll position from localStorage after restoring
        localStorage.removeItem('scrollPos');
    }
    $("#registration").validate({
        rules: {
            firstname: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            lastname: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            departments: "required",
            username: {
                required: true,
                minlength: 10,
                maxlength: 20
            },
            password: {
                required: true,
                minlength: 5
            },
            cpassword: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
            email: {
                required: true,
                email: true
            },
            contact: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            }
        },
        messages: {
            contact: {
                minlength: "Please enter 10 digits",
                maxlength: "Please enter 10 digits"
            }
        }, highlight: function (element) {
            $(element).removeClass('correct-border');
            $(element).addClass('error-border');
        }, unhighlight: function (element) {
            $(element).removeClass('error-border');
            $(element).addClass('correct-border');
        }
    });

    $("#submitButton").click(function (event) {
        event.preventDefault();
        var formVal = [];
        var formNames = [];

        $('#registration').find(":input").each(function () {
            var input = $(this);
            var names = input.attr('id');
            var value = input.val()
            formVal.push(value);
            formNames.push(names);
        });
        console.log(formVal);
        console.log(formNames);

        var form = $('#registration')[0];
        var formData = new FormData(form);
        formData.append('processing', 2);

        $.ajax({
            type: "POST",
            url: 'controller/UserController.php',
            data: formData,
            processData: false,       // don't process the data
            contentType: false,
            success: function (response) {
                var jsonData = JSON.parse(response);
                // user is logged in successfully in the back-end 
                // let's redirect 
                if (jsonData.success == 1) {
                    alert("Successfully Signed in!");
                    location.href = "login.php";
                } else if (jsonData.success == 2) {
                    alert("Email already in use!");
                } else {
                    alert("Error: " + jsonData.error);
                }

            }
        });
    });

});