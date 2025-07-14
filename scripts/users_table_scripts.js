$(document).ready(function () {
    $(".spinner-wrapper").delay(500).fadeOut("slow");


    $(".delete-button").click(function (event) {
        event.preventDefault();
        var userId = $(this).data('id');

        if (confirm('Are you sure you want to delete this user?')) {

            $.ajax({
                type: "POST",
                url: "controller/UserController.php",
                data: {
                    user_id: userId,
                    processing: 6
                },
                success: function (response) {
                    var jsonData = JSON.parse(response);

                    if (jsonData.succes == 1) {
                        alert("User deleted successfully!");
                        location.reload();
                    } else {
                        alert("Error: " + jsonData.error);
                    }
                }
            });
        }
    });

    $(".update-button").click(function (event) {
        event.preventDefault();

        var userId = $(this).data('id');

        if (confirm('Are you sure you want to update this user?')) {
            window.location.href = 'update_user.php?user_id=' + userId;
        }

    });

    $(".promote-button").click(function (event) {
        event.preventDefault();
        var userId = $(this).data('id');
        if (confirm('Are you sure you want to promote this user?')) {

            $.ajax({
                type: "POST",
                url: "controller/UserController.php",
                data: {
                    user_id: userId,
                    processing: 4
                },
                success: function (response) {
                    var jsonData = JSON.parse(response);

                    if (jsonData.success = 1) {
                        alert("User promoted successfully!");
                        location.reload();
                    } else {
                        alert("Error: " + jsonData.error);
                    }
                }
            });
        }
    });

    $(".demote-button").click(function (event) {
        event.preventDefault();
        var userId = $(this).data('id');
        if (confirm('Are you sure you want to demote this user?')) {

            $.ajax({
                type: "POST",
                url: "controller/UserController.php",
                data: {
                    user_id: userId,
                    processing: 5
                },
                success: function (response) {
                    var jsonData = JSON.parse(response);

                    if (jsonData.success == 1) {
                        alert("User demoted successfully!");
                        location.reload();
                    } else {
                        alert("Error: " + jsonData.error);
                    }
                }
            });
        }
    });


    $("#search-user").on("keyup", function () {
        var query = $(this).val().toLowerCase();

        $("#users_table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
        });
    });

    $("#search-user-select").on("change", function () {
        var selectedDepartment = $(this).val().toLowerCase();

        $("#users_table tbody tr").filter(function () {
            var departmentValue = $(this).find("td:nth-child(3)").text().toLowerCase();

            $(this).toggle(departmentValue.indexOf(selectedDepartment) > -1);
        });
    });


});