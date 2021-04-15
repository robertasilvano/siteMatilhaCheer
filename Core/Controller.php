<?php 

namespace Core;

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
}
?>