<?php

session_start();
require_once ("classe_atleta.php");

if(!isset($_GET['id_del'])) {
    header("location: cadastro.php?error=true");
}

else {
    
    $atleta = new Atleta();

    if ($atleta->delete($_GET['id_del'])) {
        $_SESSION['delete'] = 'delete_ok';
    }
    else {  
        $_SESSION['delete'] = 'delete_erro';
    }

    echo "<script> location.href = 'cadastro.php' </script>";
    
}

?>