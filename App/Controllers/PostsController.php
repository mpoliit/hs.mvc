<?php


namespace Controllers;


use Core\AbsController;

class PostsController extends AbsController
{
    public function index(){
        print_r(__METHOD__);
    }

    public function edit(int $id){
        print_r(__METHOD__);
        echo '<pre>';
        print_r($id);
        echo '<pre>';
    }

    public function editNews(string $alias){
        print_r(__METHOD__);
        echo '<pre>';
        print_r($alias);
        echo '<pre>';
    }
}