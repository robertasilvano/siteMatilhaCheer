<?php 
    session_start();

    //verifica se foi tentado fazer o login
    if (isset($_POST['login'])) {

        //verifica se as infos do login estão corretas
        if ($_POST['user'] == 'roberta' && $_POST['password'] == '123') {

            $_SESSION['user'] = $_POST['user'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['logado'] = true;

            //se sim, faz o login e redireciona pra página de atleta
            echo "<script> location.href = 'atletas.php' </script>";
        }

        //se não, verifica qual das infos do login estão erradas, e retorna pra página de login
        else {
            if ($_POST['user'] != 'roberta' && $_POST['password'] != '123'){
                $_SESSION['user'] = 'login_invalido';
                $_SESSION['password'] = 'password_invalido';
            }
            else if ($_POST['user'] != 'roberta') {
                $_SESSION['user'] = 'login_invalido';
                $_SESSION['password'] = '';
            }
            else if ($_POST['password'] != '123') {
                $_SESSION['user'] = '';
                $_SESSION['password'] = 'password_invalido';
            }

            echo "<script> location.href = 'login.php' </script>";
        }
    }

    //se for solicitado o logout, destroi a sessão e retorna pra página de login
    if (isset($_POST['logout'])) {
        session_destroy();
        echo "<script> location.href = 'login.php' </script>";
    }
?>