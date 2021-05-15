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
       
       if($user->insert()) $user->cadastrado = 'sim';
       else $user->cadastrado = 'erro';

       View::renderTemplate('Diretoria/cadastro.html', ['user' => $user]);
   }

    protected function anterior() {
        //echo "(ANTERIOR) ";
    }

    protected function posterior() {
        //echo "(POSTERIOR) ";
    }
}
?>