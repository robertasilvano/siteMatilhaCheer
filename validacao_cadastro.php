<?php

session_start();
require_once ("classe_atleta.php");

// Script para tratar os dados do formulário de 
// cadastro de usuários

if(!isset($_POST['cadastrar'])) {
    header("location: cadastro.php?error=true");
}

else {
    $nome_a = $_POST['nome_a'];
    $user_a = $_POST['user_a'];
    $pass_a = $_POST['pass_a'];
    $nascimento_a = $_POST['nascimento_a'];
    $telefone_a = $_POST['telefone_a'];
    $convenio_a = $_POST['convenio_a'];
    $tipoSangue_a = $_POST['tipoSangue_a'];
    $cpf_a = $_POST['cpf_a'];

    if(isset($_POST['diretoria_a'])) $diretoria_a = 1;
    else $diretoria_a = 0;

    $atleta = new Atleta();
    $atleta->setNome($nome_a);
    $atleta->setUser($user_a);
    $atleta->setPass($pass_a);
    $atleta->setNascimento($nascimento_a);
    $atleta->setTelefone($telefone_a);
    $atleta->setConvenio($convenio_a);
    $atleta->setTipoSangue($tipoSangue_a);
    $atleta->setCPF($cpf_a);
    $atleta->setDiretoria($diretoria_a);

    if ($atleta->insert()) {
        $_SESSION['cadastrar'] = 'user_cadastrado';
    }
    else {  
        $_SESSION['cadastrar'] = 'user_invalido';
        
    }
    
    echo "<script> location.href = 'cadastro.php' </script>";
}

?>