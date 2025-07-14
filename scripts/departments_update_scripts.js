
$(document).ready(function () {
    $(".spinner-wrapper").delay(500).fadeOut("slow");

    $("#update-departments-form").validate({
        rules: {

            1: {
                required: true,
                minlength: 2,
                maxlength: 30
            },

            2: {
                required: true,
                minlength: 2,
                maxlength: 30
            },
            3: {
                required: true,
                minlength: 2,
                maxlength: 30
            },

            4: {
                required: true,
                minlength: 2,
                maxlength: 30
            }
        },
        highlight: function (element) {
            $(element).removeClass('correct-border');
            $(element).addClass('error-border');
        },
        unhighlight: function (element) {
            $(element).removeClass('error-border');
            $(element).addClass('correct-border');
        }

    });

    $("#update-department-button").click(function (event) {
        event.preventDefault();
        if (confirm("Are you sure you want to update the Departments?")) {
            var formData = $("#update-departments-form").serialize();

            $.ajax({
                type: "POST",
                url: "controller/DepartmentController.php",
                data: formData,
                success: function (response) {
                    var jsonData = JSON.parse(response);

                    if (jsonData.success == 1) {
                        alert("Departments updated successfully!");
                        location.href = "index.php";
                    } else {
                        alert("Error: " + jsonData.error);
                    }
                }

            });
        }
    });
});