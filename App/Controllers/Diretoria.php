<?php 

namespace App\Controllers;

use App\Models\User;
use App\Models\Falta;
use App\Auth;
use App\Flash;
use \Core\View;

class Diretoria extends \Core\Controller {

    protected function anterior() {
        $this->loginObrigatorio();
        $this->loginDiretoria();
    }

    public function indexAction() {
        View::renderTemplate('Diretoria/index.html');
    }

   public function cadastroAction() {
       $users = User::selectAll();
       
       View::renderTemplate('Diretoria/cadastro.html', ['users' => $users]);
    }
    
    public function cadastrarAction() {
       $user = new User($_POST);
       
       if ($user->insert()) {
           Flash::addMensagens('Atleta cadastrado com sucesso!');
           $this->redirecionar('/diretoria/cadastro');
       }
       else {
            Flash::addMensagens('Erro ao cadastrar atleta!');
           $users = User::selectAll();
           
            View::renderTemplate('Diretoria/cadastro.html', ['user' => $user, 'users' => $users]);
       }
   }

   public function updateAction() {
        View::renderTemplate('Diretoria/update.html', ['user' => Auth::getUserByID()]);
   }

   public function alterarAction() {
       
       $id = Auth::getIDByURL();

        $user = new User($_POST);
        $user->id = $id;

       if ($user->update($user)) {
           Flash::addMensagens('Alteração realizada com sucesso!');
           $this->redirecionar('/diretoria/cadastro');
       }
       else {
           Flash::addMensagens('Erro ao fazer alteração!');
           View::renderTemplate('Diretoria/update.html', ['user' => $user]);
       }
   }

   public function deleteAction() {
       
       $id = Auth::getIDByURL();

        $user = Auth::getUserByID($id);

       if ($user->user == 'admin') {
            Flash::addMensagens('Não é possível deleter o admin!');
       }
        else if ($user->delete($user)) {
           Flash::addMensagens('Delete realizado com sucesso!');
        }
        else {
            Flash::addMensagens('Erro ao fazer alteração!');
        }
        $this->redirecionar('/diretoria/cadastro');
   }

   public function faltasAction() {
        $faltas = Falta::selectAllByIDAtleta();

        View::renderTemplate('Diretoria/faltas.html', ['faltas' => $faltas]);
    }

    public function pesquisaFaltaAction() {
        $nome = $_POST['nome'];
        $faltas = Falta::selectByNome($nome);

        View::renderTemplate('Diretoria/faltas.html', ['faltas' => $faltas]);
    }

    public function updateFaltaAction() {
        View::renderTemplate('Diretoria/update-falta.html', ['falta' => Auth::getFaltaByID()]);
   }

   public function alterarFaltaAction() {
       
    $id = Auth::getIDByURL();

    $falta = new Falta($_POST);
    $falta->id = $id;

    $uploadOK = $falta->trataArquivo();

    if ($uploadOK == 1) {
        if ($falta->update($falta)) {
            Flash::addMensagens('Alteração realizada com sucesso!');
            $this->redirecionar('/diretoria/faltas');
        }
    }

    $falta->deletaArquivo();
    Flash::addMensagens('Erro ao fazer alteração!');
    View::renderTemplate('Diretoria/update-falta.html', ['falta' => $falta]);
    }

    public function deleteFaltaAction() {
       
        $id = Auth::getIDByURL();
    
         $falta = Auth::getFaltaByID($id);
    
         if ($falta->delete($falta)) {
            Flash::addMensagens('Delete realizado com sucesso!');
         }
         else {
             Flash::addMensagens('Erro ao fazer alteração!');
         }
         $this->redirecionar('/diretoria/faltas');
    }
    
}

?>