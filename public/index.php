<?php

echo $_SERVER['DOCUMENT_ROOT'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use \app\core\Application;

$app = new Application();

$app->router->get('/', function (): void {
    echo 'Hello world!';
});

$app->router->get('/contacts', function (): void {
    echo 'Контакты!';
});

echo 'Run called!';
$app->run();


