<?php

//index
$router->addRoute('', 'HomeController@index');
$router->addRoute('home', 'HomeController@index');

//auth
$router->addRoute('login', 'AuthController@login');
$router->addRoute('registration', 'AuthController@registration');
$router->addRoute('auth', 'AuthController@auth');
$router->addRoute('logout', 'AuthController@logout');
$router->addRoute('verify', 'AuthController@verifiAuth');
$router->addRoute('2auth', 'AuthController@showQr');
$router->addRoute('2auth-code', 'AuthController@showCodeQr');
$router->addRoute('2auth-verify', 'AuthController@verify2auth');


//user
$router->addRoute('user/store', 'UserController@store');
$router->addRoute('user/index', 'UserController@index');
$router->addRoute('user/edit', 'UserController@edit');

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

