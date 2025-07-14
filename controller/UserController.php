<?php


require_once '../model/User.php';
$processing = $_POST['processing'];





if (isset($processing) && $processing) {

    switch ($processing) {
        case 1:

            //LOGIN

            if (
                isset($_POST['lusername']) && $_POST['lusername']
                && isset($_POST['lpassword']) && $_POST['lpassword']
            ) {

                $user = new User();
                $success = $user->Login($_POST['lusername'], $_POST['lpassword']);

                if ($success) {
                    echo json_encode(['success' => 1]);
                } else {
                    echo json_encode(['success' => 2]);
                }
            } else {
                echo json_encode(array("succes" => 0));
            }

            break;

        case 2:

            //REGISTER

            if (
                isset($_POST['firstname']) && $_POST['firstname']
                && isset($_POST['lastname']) && $_POST['lastname']
                && isset($_POST['departments']) && $_POST['departments']
                && isset($_POST['username']) && $_POST['username']
                && isset($_POST['password']) && $_POST['password']
                && isset($_POST['email']) && $_POST['email']
                && isset($_POST['contact']) && $_POST['contact']
            ) {

                $user = new User();
                $succes = $user->Registration(
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['departments'],
                    $_POST['username'],
                    $_POST['password'],
                    $_POST['email'],
                    $_POST['contact'],
                    $_FILES['profile-pic']
                );

                if ($succes == 1) {

                    echo json_encode(array('success' => 2));
                } else if ($succes == 2) {
                    echo json_encode(array('success' => 1));
                } else {
                    echo json_encode(array('success' => 0, "error" => "Invalid Credentials!"));
                }
            } else {
                echo json_encode(array('success' => 0, "error" => "_POST doesn't work!"));
            }
            break;


        case 3:

            //UPDATE USER

            if (isset($_POST['user_id'])) {

                $user = new User();
                $succes = $user->UpdateUser(
                    $_POST['user_id'],
                    $_POST['u_firstname'],
                    $_POST['u_lastname'],
                    $_POST['u_department'],
                    $_POST['u_username'],
                    $_POST['u_email'],
                    $_FILES['profile-pic']
                );

                if ($succes) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("success" => 0, "error" => "Unable to update the user!"));
                }
            } else {
                echo json_encode(array("success" => 0, "error" => "Failed to find the User"));
            }
            break;

        case 4:

            //PROMOTE USER

            if (isset($_POST['user_id'])) {

                $user = new User();
                $succes = $user->PromoteUser($_POST['user_id']);

                if ($succes) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("success" => 0, "error" => "Failed to Promote the User!"));
                }
            } else {
                echo json_encode(array("success" => 0, "error" => "Unauthorized or Invalid Request!"));
            }

            break;

        case 5:

            //DEMOTE USER

            if (isset($_POST['user_id'])) {

                $user = new User();
                $succes = $user->DemoteUser($_POST['user_id']);

                if ($succes) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("success" => 0, "error" => "Unable to demote the user!"));
                }
            } else {
                echo json_encode(array("success" => 0, "error" => "Unauthorized or Invalid Request!"));
            }


            break;

        case 6:

            if (isset($_POST['user_id'])) {

                $user = new User();
                $succes = $user->DeleteUser($_POST['user_id']);

                if ($succes) {
                    echo json_encode(array("succes" => 1));
                } else {
                    echo json_encode(array("succes" => 0, "error" => "Failed to delete user!"));
                }
            } else {
                echo json_encode(array("succes" => 0, "error" => "Unauthorized or Invalid Request!"));
            }

            break;

        default:
            echo "Nicio actiune gasita!";
    }
} else {
    echo "Nici-un proces valabil!";
}
