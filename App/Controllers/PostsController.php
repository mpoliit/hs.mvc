<?php


namespace Controllers;


class PostsController
{
    public function index(){
        print_r(__METHOD__);
    }

    public function edit($param){
        print_r(__METHOD__);
        echo '<pre>';
        print_r('key = ' . $param);
        echo '<pre>';
    }
}