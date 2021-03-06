<?php include_once "functions_mysqli.php" ?>
<?php include_once "functions_pdo.php" ?>
<?php include_once "db_pdo.php" ?>
<?php session_start(); ?>
<?php

if (isset($_POST['login'])) {
    $login_user_name = $_POST['user_name'];
    $login_user_password = $_POST['user_password'];

    $user = getLoginUserPdo($login_user_name, $pdo);

    $count = count($user);

    if ($count == 0) {
        header("Location: ../index.php");
    } else {
        $user_name = $user['user_name'];
        $user_password = $user['user_password'];
        $user_id = $user['user_id'];
        $user_email = $user['user_email'];
        $user_firstname = $user['user_firstname'];
        $user_lastname = $user['user_lastname'];
        $user_image = $user['user_image'];
        $user_role = $user['user_role'];

        if (password_verify($login_user_password, $user_password)) {
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_firstname'] = $user_firstname;
            $_SESSION['user_lastname'] = $user_lastname;
            $_SESSION['user_role'] = $user_role;

            header("Location: ../admin");
        }
    }
}
?>