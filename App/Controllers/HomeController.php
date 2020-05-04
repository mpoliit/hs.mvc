<?php

namespace Controllers;

use Core\AbsController;
use Core\View;

class HomeController extends AbsController
{
    public function index(){
        View::render('home/index.php');
    }
}