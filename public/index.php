<?php 

require_once dirname(__DIR__).'/vendor/autoload.php';

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

session_start();

$roteador = new Core\Rotear();

$roteador->add('', ['controller' => 'Home', 'action' => 'index']);
$roteador->add('logout', [
    'controller' => 'Login',
    'action' => 'sair'
]);
$roteador->add('{controller}', ['action' => 'index']);
$roteador->add('{controller}/{action}');
$roteador->add('{controller}/{action}/{id:\d+}');
$roteador->add('admin/{controller}/{action}', [
    'namespace' => 'Admin'
]);

$roteador->dispatch($_SERVER['QUERY_STRING']);

?>