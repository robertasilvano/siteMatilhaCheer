<?php

require_once ("classe_atleta.php");

$atleta = new Atleta();

$select = $atleta->select();

if(count($select) > 0) {
    $_SESSION['select'] = True;
}
else {
    $_SESSION['select'] = False;
}


function tabela($select) {
    for ($i=0; $i < count($select); $i++) {
        echo "<tr>";
        foreach ($select[$i] as $k => $v) {
            if ($k != 'diretoria') {
                echo "<td>" . $v . "</td>";
            }
            else {
                if ($v == 1) {
                    echo "<td> Sim </td>";
                }
                else {
                    echo "<td> Não </td>";
                }
            }
        }
        echo "<td><a class='btn btn-outline-warning btn-sm' href='cadastro.php?id_del=". $select[$i]['id'] . "'>Excluir</a><a class='btn btn-outline-warning btn-sm' href='cadastro.php?id_up=". $select[$i]['id'] . "'>Editar</a></td>";
        echo "</tr>";
    }
}



?>
