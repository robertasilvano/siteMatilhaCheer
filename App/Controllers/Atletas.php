<?php 

namespace App\Controllers;

use App\Models\User;
use \Core\View;

class Atletas extends \Core\Controller {

    public function indexAction() {
        $atletas = User::selectAll();

        View::renderTemplate('Atletas/index.html', ['atletas' => $atletas]);
    }

    protected function anterior() {
        //echo "(ANTERIOR) ";
    }

    protected function posterior() {
        //echo "(POSTERIOR) ";
    }
}
?>