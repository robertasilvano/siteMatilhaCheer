<?php 

    require_once("classe_atleta.php");
    $atleta = new Atleta();

    //verifica se foi tentado fazer o login
    if (isset($_POST['login'])) {
        $atleta->logar($_POST);
    }
        
    //se for solicitado o logout, destroi a sessão e retorna pra página de login
    if (isset($_POST['logout'])) {
        session_start();
        session_destroy();
        echo "<script> location.href = 'login.php' </script>";
    }
?>

