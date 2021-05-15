<?php 

namespace App\Controllers;

use App\Models\User;
use \Core\View;

class Diretoria extends \Core\Controller {

    public function indexAction() {

        View::renderTemplate('Diretoria/index.html');
    }

   public function cadastroAction() {

        View::renderTemplate('Diretoria/cadastro.html');
   }

   public function cadastrarAction() {
       $user = new User($_POST);
       
       if ($user->insert()) {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/diretoria/sucesso', true, 303);
            exit;
       }
       else {
            View::renderTemplate('Diretoria/cadastro.html', ['user' => $user]);
       }
   }

   public function sucessoAction() {
       
        View::renderTemplate('Diretoria/cadastro.html', ['sucesso' => 1]);
   }

    protected function anterior() {
        //echo "(ANTERIOR) ";
    }

    protected function posterior() {
        //echo "(POSTERIOR) ";
    }
}
?>