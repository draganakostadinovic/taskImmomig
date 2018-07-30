<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/home', function (Request $request, Response $response, array $args) {
    return $this->renderer->render($response, 'home.html');
});

$app->get('/registration', function (Request $request, Response $response, array $args) {
    if($_SESSION){
        return $this->response->withRedirect('/upload');
    } else {
        return $this->view->render($response, 'registration.twig');
    }
});

$app->get('/login', function (Request $request, Response $response, array $args) {
    if($_SESSION){
        return $this->response->withRedirect('/upload');
    } else {
        return $this->view->render($response, 'login.twig');
    }
});

$app->post('/registration', '\App\Controllers\UsersController:createUser');
$app->post('/login', '\App\Controllers\UsersController:login');
$app->get('/logout', '\App\Controllers\UsersController:logOut');
