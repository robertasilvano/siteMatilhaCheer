<?php 

namespace App\Controllers;

use App\Models\User;
use \Core\View;

class Atletas extends \Core\Controller {

    protected function anterior() {
        $this->loginObrigatorio();
    }

    public function indexAction() {
        View::renderTemplate('Atletas/index.html');
    }

    public function faltasAction() {
        View::renderTemplate('Atletas/faltas.html');
    }

    public function novaFaltaAction() {

        $this->trataArquivo();

        $diretorio = "uploads/";
        $arquivo = $diretorio . basename($_FILES["arquivo"]["name"]);
        $uploadOK = 1;

        $ext = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["arquivo"]["tmp_name"]);
        
        
        //$this->redirecionar('/atletas');
    }

}
?>