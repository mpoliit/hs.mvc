<?php

namespace Controllers;

use Core\AbsController;
use Core\View;
use Models\Post;

class HomeController extends AbsController
{
    public function index(){
        $post = new Post();

        $postData = $post->selectAllPost();

        View::render('home/index.php', ['data' => $postData]);
    }
}