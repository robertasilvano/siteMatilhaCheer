<?php 

    if (!isset($_SESSION['logado']) || $_SESSION['logado'] == false) {
        echo "<script> location.href = 'login.php' </script>";
    }

?>