<?php

namespace App;

Use \App\Models\User;
Use \App\Models\Falta;

class Auth {

    public static function login($user) {

        $_SESSION['user_nome'] = $user->nome;
        $_SESSION['user_id'] = $user->id;
        
    }

    public static function logout() {
        
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
    }

    public static function getUser() {

        if (isset($_SESSION['user_id'])) {
            return User::findByID($_SESSION['user_id']);
        }
    }
    
    public static function getIDByURL() {
        return explode('/', $_SERVER['REQUEST_URI'])[3];
    }

    public static function getUserByID() {
        
        $id = Auth::getIDByURL();
        return User::findByID($id);
    }

    public static function getFaltaByID() {
        
        $id = Auth::getIDByURL();
        return Falta::findByID($id);
    }

    public static function salvarPaginaRetorno() {

        $_SESSION['pagina'] = $_SERVER['REQUEST_URI'];
    }

    public static function getPaginaRetorno() {
        return $_SESSION['pagina'] ?? '/atletas/index';
    }

    public static function getDiretoria() {
        $user = Auth::getUser();

        if ($user->diretoria == 1) return true;
        else return false;
    }
}

?>