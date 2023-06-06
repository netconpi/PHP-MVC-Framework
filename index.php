<?php

require_once __DIR__.'/vendor/autoload.php';
use \app\core\Application;

$app = new Application();

$app->router->get('/', function (): void {
    echo 'Hello world!';
});
$app->router->get('/contacts', function (): void {
    echo 'Контакты!';
});

$app->run();


