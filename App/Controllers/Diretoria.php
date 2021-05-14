<?php 

namespace App\Controllers;

use \Core\View;

class Diretoria extends \Core\Controller {

    public function indexAction() {

        View::renderTemplate('Diretoria/index.html');
    }

   public function cadastroAction() {

        View::renderTemplate('Diretoria/cadastro.html');
   }

    protected function anterior() {
        //echo "(ANTERIOR) ";
    }

    protected function posterior() {
        //echo "(POSTERIOR) ";
    }
}
?>