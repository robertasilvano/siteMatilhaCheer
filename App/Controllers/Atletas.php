<?php 

namespace App\Controllers;

use App\Models\Atleta;
use \Core\View;

class Atletas extends \Core\Controller {

    public function indexAction() {
        $atletas = Atleta::getAll();

        View::renderTemplate('Atletas/index.html', ['atletas' => $atletas]);
    }

    public function addNovo() {
        echo "Hello de dentro do método addNovo (ação) no controlador posts";
    }

    protected function anterior() {
        //echo "(ANTERIOR) ";
    }

    protected function posterior() {
        //echo "(POSTERIOR) ";
    }
}
?>