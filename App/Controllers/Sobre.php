<?php 

namespace App\Controllers;

use \Core\View;

class Sobre extends \Core\Controller {
    public function indexAction() {

        View::renderTemplate('Sobre/index.html');
    }
}


?>