<?php

session_start();
require_once ("classe_atleta.php");

$atleta = new Atleta();

$id_del = $_GET['id_del'];
echo "<script> location.href = 'validacao_delete?id_del=". $id_del .".php' </script>";

?>