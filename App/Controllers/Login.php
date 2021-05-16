<?php 

namespace App\Controllers;

use \App\Auth;
use \App\Models\User;
use \App\Flash;
use \Core\View;

class Login extends \Core\Controller {
    public function indexAction() {

        View::renderTemplate('Login/index.html');
    }

    public function novoAction() {
        $user = User::autenticar($_POST['user'], $_POST['pass']);

        if ($user) {

            Auth::login($user);

            Flash::addMensagens("Usuário logado com sucesso!");

            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/atletas', true, 303);
            exit;
        }
        else {
            Flash::addMensagens("Problema ao fazer login!");
            View::renderTemplate('Login/index.html', ['user' => $_POST['user']]);
        }
    }

    public function sairAction() {
        
        Auth::logout();

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login/msg-logout', true, 303);
        
    }

    public function msgLogoutAction() {
        Flash::addMensagens("Logout com sucesso!");

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login/index', true, 303);
        exit;
        
    }

    protected function anterior() {
        //echo "(ANTERIOR) ";
    }

    protected function posterior() {
        //echo "(POSTERIOR) ";
    }
}


?>