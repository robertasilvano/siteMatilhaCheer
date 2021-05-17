<?php 

namespace App\Controllers;

use App\Models\User;
use \Core\View;

class Atletas extends \Core\Controller {

    protected function anterior() {
        $this->loginObrigatorio();
    }

    public function indexAction() {
        View::renderTemplate('Atletas/index.html');
    }

}
?>