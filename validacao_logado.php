<?php 

    if (isset($_SESSION['logado'])) {
        if ($_SESSION['logado'] == true) {
            echo "<script> location.href = 'logout.php' </script>";
        }
    }

?>