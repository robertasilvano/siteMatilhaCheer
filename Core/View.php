<?php 

namespace Core;

class View {

    public static function render($view, $args = []) {
        extract($args, EXTR_SKIP);
        
        $file = "../App/Views/$view";
        
        if (is_readable($file)) {
            require $file;
        } 
        else {
            throw new \Exception("$file não encontrado!");
        }
    }

    public static function renderTemplate($template, $args = []) {
        static $twig = null;

        if ($twig == null) {
            $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal('user_logado', \App\Auth::getUser());
            $twig->addGlobal('mensagens_flash', \App\Flash::getMensagens());
        }

        echo $twig->render($template, $args);
    }
}



?>