<?php

namespace Controllers\Api\v1;

abstract class Controller
{
    protected $allowedMethod = ["GET"];
    protected $errors = [
        'method_not_allowed' => [
            'code'          => '405',
            'name'          => 'Method Not Allowed',
            'description'   => 'Current method {%s} not allowed.'
        ]
    ];


    protected function before()
    {
        if(!in_array($_SERVER['REQUEST_METHOD'], $this->allowedMethod)){
            $this->errors['method_not_allowed']['description'] = sprintf(
                $this->errors['method_not_allowed']['description'],
                $_SERVER['REQUEST_METHOD']
            );

            $this->getHeaders();
            echo json_encode($this->errors['method_not_allowed']);
            die();
        }
    }

    abstract public function __invoke();

    protected function getHeaders($code = 200)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: " . implode($this->allowedMethod));
        header("Access-Control-Max-Age: 3600");
        http_response_code($code);
    }
}