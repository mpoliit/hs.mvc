<?php

//index
$router->addRoute('', 'HomeController@index');
$router->addRoute('home', 'HomeController@index');

//auth
$router->addRoute('login', 'AuthController@login');
$router->addRoute('registration', 'AuthController@registration');
$router->addRoute('auth', 'AuthController@auth');
$router->addRoute('logout', 'AuthController@logout');

//user
$router->addRoute('user/store', 'UserController@store');

//post
$router->addRoute('post/create', 'PostsController@create');
$router->addRoute('post/store', 'PostsController@store');
$router->addRoute('post/{id:\d+}/view', 'PostsController@view');
$router->addRoute('post/{id:\d+}/delete', 'PostsController@delete');
$router->addRoute('post/{id:\d+}/edit', 'PostsController@edit');
$router->addRoute('post/{id:\d+}/update', 'PostsController@update');
$router->addRoute('posts/user/{id:\d+}/view', 'PostsController@postOneUser');

//migrate
$router->addRoute('migrate', 'MigrateController@migrate');

