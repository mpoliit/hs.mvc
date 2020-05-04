<?php

namespace Core;

class Router
{
    protected $uri;

    protected $routes = [];

    protected $type = [
        'd' => 'int',
        'w' => 'str'
    ];

    public function addRouter($route, $action){
        $params = [];

        //чилосвые параметры
        preg_match_all("/{\w+:\\\i}/", $route, $match_int, PREG_SET_ORDER);

        if ($match_int){
            $checkParams = $this->checkParamRouter($match_int, $route, 'int');

            $route = $checkParams['route'];
            $params = $checkParams['params'];
            array_push($this->routes, ['route' => $route, 'action' => $action, 'params' => $params]);
            return;
        }

        //строковые параметры
        preg_match_all("/{\w+:\\\s}/", $route, $match_string, PREG_SET_ORDER);

        if ($match_string){
            $checkParams = $this->checkParamRouter($match_int, $route, 'str');

            $route = $checkParams['route'];
            $params = $checkParams['params'];
            array_push($this->routes, ['route' => $route, 'action' => $action, 'params' => $params]);
            return;
        }

        //все другие параметры
        $route = preg_replace('/\//', '\/', $route);
        $route = '/^' . $route . '/';

        array_push($this->routes, ['route' => $route, 'action' => $action, 'params' => $params]);

    }

    public function checkParamRouter($match, $route, $type){
        $type = array_search($type, $this->type);
        $params = [];

        foreach ($match as $param){
            preg_match('/\w+:/', $param[0], $name_param, PREG_OFFSET_CAPTURE);
            preg_match('/\w+:/', $param[0], $value_param, PREG_OFFSET_CAPTURE);

            $params_value = '\/\\' . $type . '+\/';

            $key = substr($name_param[0][0], 0, -1);
            $params[$key] = $params_value;
        }

        $route = str_replace('/', '\/', $route);
        $replacement = '\\' . $type . '+';
        $route = preg_replace ('/{\w+:\\\\\w+}/', $replacement, $route);
        $route = '/^' . $route . '/';

        return ['route' => $route, 'params' => $params];

    }

    public function getRouters(){
        echo '<pre>';
        print_r($this->routes);
        echo '</pre>';
    }

    public function dispatch($url){
        $this->uri = $url;
        //оберазем /


        //проверка существования роута
        $params = $this->checkRouter();

        if(is_string($params['action'])){
            $params['action'] = explode('@', $params['action']);

            $controller = '\Controllers\\' . $params['action'][0];
            if (class_exists($controller)){
                $controller = new $controller;
                if (isset($params['params'])){
                    call_user_func_array(array($controller, $params['action'][1]), $params['params']);
                } else {
                    call_user_func([$controller, $params['action'][1]]);
                }
            } else {
                throw new \Exception("Controller $controller not found.");
            }
        }
    }

    protected function checkRouter(){
        if (strstr($this->uri, '?')){
            $url = strstr($this->uri, '?', true);
        } else {
            $url = $this->uri;
        }


        $url = ($url != '/') ? trim($url, '/') : $url;

        foreach ($this->routes AS $router) {
            preg_match_all($router['route'], $url, $match, PREG_SET_ORDER);

            if ($match) {
                if (count($router['params'])){
                    $key = array_keys($router['params'])[0];
                    $reg = '/' . $router['params'][$key] . '/';
                    preg_match_all($reg, $url, $match_value, PREG_SET_ORDER);
                    $val = $match_value[0][0];
                    $val = trim($val, '/');

                    $router['params'][$key] = $val;
                }

                return $router;
            }
        }
        return ['action' => 'ErrorController@error404'];
    }
}