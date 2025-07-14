$(document).ready(function () {
    $(".spinner-wrapper").delay(500).fadeOut("slow");
    $("#user_update_form").validate({
        rules: {
            u_firstname: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            u_lastname: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            u_department: "required",
            u_username: {
                required: true,
                minlength: 10,
                maxlength: 20
            },
            u_email: {
                required: true,
                email: true
            }

        }, highlight: function (element) {
            $(element).removeClass('correct-border');
            $(element).addClass('error-border');
        }, unhighlight: function (element) {
            $(element).removeClass('error-border');
            $(element).addClass('correct-border');
        }
    });

    $("#user_update_form").submit(function (event) {
        event.preventDefault();

        var form = $('#user_update_form')[0];
        var formData = new FormData(form);
        formData.append('processing', 3);

        $.ajax({
            type: "POST",
            url: "controller/UserController.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                var jsonData = JSON.parse(response);

                if (jsonData.success == 1) {
                    alert("User updated successfully!");
                    location.href = "view_users.php";

                } else {
                    alert("Error: " + jsonData.error);
                }
            }
        });
    });

});