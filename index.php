<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use \app\core\Application;
use \app\controllers\SiteController;

$app = new Application();

$app->router->get('/', [new SiteController(), 'main']);

$app->router->get('/contacts', [new SiteController(), 'contact']);

$app->router->post('/contacts', [new SiteController(), 'handleContact']);

echo $app->run();


