<?php 

namespace App\Controllers;

use App\Models\Post;
use \Core\View;

class Atletas extends \Core\Controller {

    public function indexAction() {
        $posts = Post::getAll();

        View::renderTemplate('Atletas/index.html', ['posts' => $posts]);
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