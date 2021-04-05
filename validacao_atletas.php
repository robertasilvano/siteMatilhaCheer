<?php 

    // verifica se o usuário está logado. se não estiver, redireciona pra página de login.
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] == false) {
        echo "<script> location.href = 'login.php' </script>";
    }

?>