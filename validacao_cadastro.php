<?php

require_once("cadastro.php");

if(isset($_POST['cadastrar'])) {

    $nome = $_POST['nome'];
    $user = $_POST['user'];
    $pass = $_POST['password'];
    $nascimento = $_POST['nascimento'];
    $telefone = $_POST['telefone'];
    $convenio = $_POST['convenio'];
    $tipo_sangue = $_POST['tipo_sangue'];
    $cpf = $_POST['cpf'];

    if (isset($_POST['diretoria'])) {
        $diretoria = 1;
    }
    else {
        $diretoria = 0;
    }

    if ($a->insert($nome, $user, $pass, $nascimento, $telefone, $convenio, $tipo_sangue, $cpf, $diretoria)) {
        $_SESSION['cadastrar'] = 'user_cadastrado';
    }
    else {    
        $_SESSION['cadastrar'] = 'user_invalido';
    }

    echo "<script> location.href = 'cadastro.php' </script>";

}


?>