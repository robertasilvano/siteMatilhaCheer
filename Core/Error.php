<?php

namespace Core;

class Error {

    public static function errorHandler($level, $message, $file, $line) {
        if (error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    public static function exceptionHandler($exception) {
        $code = $exception->getCode();
        if($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        if(\App\Config::SHOW_ERRORS) {
            echo "<h1>Fatal error</h1>";
            echo "<p>Exceção não encontrada: '" . get_class($exception) . "'</p>";
            echo "<p>Mensagem: '" . $exception->getMessage() . "'</p>";
            echo "<p>Stack trace: <pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Exceção lançada em: '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
        }
        else {
            $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);

            $message = "Exceção não encontrada: '" . get_class($exception) . "'";
            $message .= " com a mensagem '" . $exception->getMessage() . "'";
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nExceção lançada em '" . $exception->getFile() . "' on line " . $exception->getLine();

            error_log($message);

            View::renderTemplate("$code.html");
        }
    }
}