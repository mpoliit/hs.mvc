<?php
/**
 * i - int
 * s - string
 */

//index
$router->addRouter('/', 'HomeController@index');
$router->addRouter('home', 'HomeController@index');

//post
$router->addRouter('posts/index', 'PostsController@index');
$router->addRouter('posts/{id:\i}/edit', 'PostsController@edit');

//test news
$router->addRouter('news/{id:\s}/edit', 'PostsController@edit');
