<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use \app\core\Application;

$app = new Application();

$app->router->get('/', 'home');

$app->router->get('/contacts', 'contacts');

$app->run();


