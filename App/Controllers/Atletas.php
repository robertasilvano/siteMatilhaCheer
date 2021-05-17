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
        $faltas = Falta::selectAllByUser();

        View::renderTemplate('Atletas/faltas.html', ['faltas' => $faltas, 'nome' => $_SESSION['user_nome']]);
    }

    public function novaFaltaAction() {
        $falta = new Falta($_POST);

        $uploadOK = $falta->trataArquivo();
        
        if ($uploadOK == 1) {
            if ($falta->insert()) {
                Flash::addMensagens('Falta inserida com sucesso!');
                $this->redirecionar('/atletas/faltas');
            }
        }

        Flash::addMensagens('Erro ao inserir falta!');
        $faltas = Falta::selectAllByUser();
        View::renderTemplate('Atletas/faltas.html', ['falta' => $falta, 'faltas' => $faltas]);
    }

}
?>