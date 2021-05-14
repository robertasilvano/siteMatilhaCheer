<?php 

namespace App\Controllers\Admin;

class Users extends \Core\Controller{

    public function indexAction() {
        echo "User Admin index";
    }

    protected function anterior() {
        if(!isset($_SESSION['logado'])) return false;
    }

}

?>