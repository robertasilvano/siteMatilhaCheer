<?php 

namespace Core;

use \App\Auth;
use App\Flash;

abstract class Controller {

    public function __call($name, $args) {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->anterior() !== false) {
                call_user_func_array([
                    $this,
                    $method
                ], $args);
                $this->posterior();
            }
        }
        else {
            throw new \Exception("O método $method não foi encontrado no Controlador " . get_class($this));
        }
    }

    protected function anterior(){}
    protected function posterior(){}

    public function redirecionar($url) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $url, true, 303);
        exit;
    }

    public function loginObrigatorio() {
        
        Auth::salvarPaginaRetorno();

        if(!Auth::getUser()) {
            Flash::addMensagens("Pagina restrita a login!");

            $this->redirecionar("/login");
        }
    }

    public function loginDiretoria() {
        $diretoria = Auth::getDiretoria();

        if (!$diretoria) {
            Flash::addMensagens("Pagina restrita a diretoria!");
            $this->redirecionar("/atletas/index");
        }
    }
    
}
?>