<?php

//index
$router->addRoute('', 'HomeController@index');
$router->addRoute('home', 'HomeController@index');

//post
$router->addRoute('posts/index', 'PostsController@index');
$router->addRoute('posts/{id:\d+}/edit', 'PostsController@edit');

//test news
$router->addRoute('news/{alias:\w+}/edit', 'PostsController@editNews');
