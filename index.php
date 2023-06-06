<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use \app\core\Application;
use \app\controllers\SiteController;

$app = new Application();

$app->router->get('/', 'home');

$app->router->get('/contacts', [SiteController::class, 'contact']);

$app->router->post('/contacts', [SiteController::class, 'handleContact']);

$app->run();


