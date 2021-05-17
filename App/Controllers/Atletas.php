<?php 

namespace App\Controllers;

use App\Models\User;
use \Core\View;
use App\Models\Falta;
use App\Flash;

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
        $falta = new Falta($_POST);

        $uploadOK = $falta->trataArquivo();
        
        if ($uploadOK == 1) {
            if ($falta->insert()) {
                $this->redirecionar('/atletas');
            }
        }
        

        View::renderTemplate('Atletas/faltas.html', ['falta' => $falta]);
    }

}
?>