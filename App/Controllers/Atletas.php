<?php 

namespace App\Controllers;

use App\Models\Falta;
use \Core\View;
use App\Flash;
use App\Auth;

class Atletas extends \Core\Controller {

    protected function anterior() {
        $this->loginObrigatorio();
    }

    public function indexAction() {
        View::renderTemplate('Atletas/index.html');
    }

    public function faltasAction() {
        $faltas = Falta::selectAllByIDAtleta($_SESSION['user_id']);

        View::renderTemplate('Atletas/faltas.html', ['faltas' => $faltas]);
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
        $faltas = Falta::selectAllByIDAtleta($_SESSION['user_id']);
        View::renderTemplate('Atletas/faltas.html', ['falta' => $falta, 'faltas' => $faltas]);
    }

    public function updateAction() {
        View::renderTemplate('Atletas/update.html', ['falta' => Auth::getFaltaByID()]);
   }

   public function alterarAction() {
       
    $id = Auth::getIDByURL();

    $falta = new Falta($_POST);
    $falta->id = $id;

    $uploadOK = $falta->trataArquivo();

    if ($uploadOK == 1) {
        if ($falta->update($falta)) {
            Flash::addMensagens('Alteração realizada com sucesso!');
            $this->redirecionar('/atletas/faltas');
        }
    }

    $falta->deletaArquivo();
    Flash::addMensagens('Erro ao fazer alteração!');
    View::renderTemplate('Atletas/update.html', ['falta' => $falta]);
}

public function deleteAction() {
       
    $id = Auth::getIDByURL();

     $falta = Auth::getFaltaByID($id);

     if ($falta->delete($falta)) {
        Flash::addMensagens('Delete realizado com sucesso!');
     }
     else {
         Flash::addMensagens('Erro ao fazer alteração!');
     }
     $this->redirecionar('/atletas/faltas');
}

}
?>