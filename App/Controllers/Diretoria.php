<?php 

namespace App\Controllers;

use App\Auth;
use App\Flash;
use App\Models\User;
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
       $atletas = User::selectAll();

        View::renderTemplate('Diretoria/cadastro.html', ['atletas' => $atletas]);
   }

   public function cadastrarAction() {
       $user = new User($_POST);
       
       if ($user->insert()) {
           $this->redirecionar('/diretoria/sucesso');
       }
       else {
            View::renderTemplate('Diretoria/cadastro.html', ['user' => $user]);
       }
   }

   public function sucessoAction() {
        View::renderTemplate('Diretoria/cadastro.html', ['sucesso' => 1]);
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
}

?>