<?php 

namespace App\Controllers;

use \Core\View;

class Login extends \Core\Controller {
    public function indexAction() {

        View::renderTemplate('Login/index.html');
    }

    public function loginAction() {
        
    }

    protected function anterior() {
        //echo "(ANTERIOR) ";
    }

    protected function posterior() {
        //echo "(POSTERIOR) ";
    }
}


?>