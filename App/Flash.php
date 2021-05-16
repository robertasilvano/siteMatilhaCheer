<?php

namespace App;

class Flash {

    public static function addMensagens($mensagem) {
        if (!isset($_SESSION['flash_notificacoes'])) {
            $_SESSION['flash_notificacoes'] = [];
        }

        $_SESSION['flash_notificacoes'][] = $mensagem;
    }

    public static function getMensagens() {
        if (isset($_SESSION['flash_notificacoes'])) {
            $msgs = $_SESSION['flash_notificacoes'];
            unset($_SESSION['flash_notificacoes']);

            return $msgs;
        }
    }
}

?>