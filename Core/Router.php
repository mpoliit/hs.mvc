<?php

namespace Core;

class Router
{
    protected $routes = [];

    protected $params = [];

    protected $convertTypesRegular = [
        'd' => 'int',
        'w' => 'string'
    ];

    public function addRoute($route, $params, $namespace = 'Controllers'){
        //escape slashes
        $route = preg_replace('/\//', '\\/', $route);
        //convert parameters {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        $route = '/^' . $route . '$/i';

        $params = explode('@', $params);
        $parameters['controller']       = $params[0];
        $parameters['action']           = $params[1];
        $parameters['namespace']        = $namespace;


        $this->routes[$route] = $parameters;
    }

    public function getRouters(){
        return $this->routes;
    }

    public function dispatch($url){
        $url = trim($url, '/');
        $url = $this->removeGetParameters($url);

        if($this->match($url)){
            $controller = $this->params['controller'];
            if (class_exists($this->params['namespace'].'\\'.$controller)){
                $controller = $this->params['namespace'].'\\'.$controller;
                $action = $this->params['action'];

                unset($this->params['controller']);
                unset($this->params['action']);
                unset($this->params['namespace']);

                $controller = new $controller;
                call_user_func_array([$controller, $action], $this->params);

            } else {
                throw new \Exception("Controller $controller not found.");
            }
        } else {
            $controller     = 'Controllers\\ErrorController';
            $action         =  'error404';

            $controller = new $controller;
            call_user_func_array([$controller, $action], $this->params);

        }
    }

    protected function removeGetParameters($url){
        if ($url != ''){
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false){
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

    public function match($url){
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)){
                preg_match_all('|\(\?P<[\w]+>\\\\(\w[\+])\)|', $route, $types);
                $step = 0;
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $types[1] = str_replace('+', '', $types[1]);
                        settype($match, $this->convertTypesRegular[$types[1][$step]]);
                        $params[$key] = $match;
                        $step++;
                    }
                }

                $this->params = $params;
                return true;
            }
        }
    }
}