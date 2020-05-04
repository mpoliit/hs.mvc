<?php


namespace Controllers;


use Core\AbsController;

class ErrorController extends AbsController
{

    public function error404(){
        echo __CLASS__;
        return;
    }
}