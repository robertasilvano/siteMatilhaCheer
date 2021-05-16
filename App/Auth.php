<?php

namespace App;

Use \App\Models\User;

class Auth {

    public static function login($user) {

        //session_generate_id(true);

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
}

?>