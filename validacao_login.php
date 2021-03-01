<?php 
    session_start();

    if (isset($_POST['user'])) {
        if ($_POST['user'] == 'robs' && $_POST['password'] == 'a') {

            $_SESSION['user'] = $_POST['user'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['logado'] = true;

            echo "<script> location.href = 'logout.php' </script>";
        }

        else {
            if ($_POST['user'] != 'robs' && $_POST['password'] != 'a'){
                $_SESSION['user'] = 'login_invalido';
                $_SESSION['password'] = 'password_invalido';
            }
            else if ($_POST['user'] != 'robs') {
                $_SESSION['user'] = 'login_invalido';
                $_SESSION['password'] = '';
            }
            else if ($_POST['password'] != 'a') {
                $_SESSION['user'] = '';
                $_SESSION['password'] = 'password_invalido';
            }

            echo "<script> location.href = 'login.php' </script>";
        }
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        echo "<script> location.href = 'login.php' </script>";
    }
?>