<?php 

    // verifica se o usuário está logado. se estiver, redireciona pra página de atletas.
    if (isset($_SESSION['logado'])) {
        if ($_SESSION['logado'] == true) {
            echo "<script> location.href = 'atletas.php' </script>";
        }
    }

?>