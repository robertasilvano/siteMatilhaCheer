<?php

namespace Core;

class Rotear {
    protected $rotas = [];
    protected $params = [];

    public function add($rota, $params = []) {
        $rota = preg_replace('/\//', '\\/', $rota);
        $rota = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $rota);
        $rota = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $rota);

        $rota = '/^' . $rota . '$/i';
        
        $this->rotas[$rota] = $params;
    }

    public function getRotas() {
        return $this->rotas;
    }

    public function match($url) {
        foreach ($this->rotas as $rota => $params) {
            if (preg_match($rota, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) { 
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }

        return False;
    }

    public function dispatch($url) {
        
        $url = $this -> removeQueryStringVariables($url);

        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            //$controller = "App\Controllers\\$controller";
            $controller = $this->getNamespace() . $controller;

            if (class_exists($controller)) {
                $controller_object = new $controller();

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if (preg_match('/action$/i', $action) == 0) {
                    $controller_object->$action();
                }
                else {
                    throw new \Exception("O método $action do controlador $controller não pode ser acessado diretamente - remova o sufixo Action dessa chamada");
                }
            }
            else {
                throw new \Exception("Classe controloradora $controller não encontrada!");
            }
        }
        else {
            throw new \Exception("Rota não encontrada!", 404);
        }
    }
    
    public function getParams() {
        return $this->params;
    }

    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }


    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

    protected function getNamespace(){
        $namespace = 'App\Controllers\\';
        
        if(array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
    }

}


/*
www.siteexemplo.com/noticias/entretenimento/10

noticia           0 - classe - controller
entretenimento    1 - metodo/funcao - action
10                2 - parametros


/home
/sobre_esporte
/login
/atletas
/atletas/faltas
/atletas/faltas/mostra_falta
/atletas/diretoria
/atletas/diretoria/cadastro
/atletas/diretoria/update
/atletas/financeiro

*/