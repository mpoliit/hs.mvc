<?php


namespace Core;


class View
{
    protected static $viewPath = '/App/Views/';

    public static function render ($view, $args = []){
        extract($args, EXTR_SKIP); //EXTR_SKIP - Если переменная с таким именем существует, ее текущее значение не будет перезаписано.

        $file = dirname(__DIR__) . static::$viewPath . $view;

        if (file_exists($file)){
            require $file;
        } else {
            throw new \Exception("$file not found.");
        }
    }
}