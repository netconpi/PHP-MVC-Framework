<?php

require_once __DIR__.'/vendor/autoload.php';
use \app\core\Application;

$app = new Application();

$app->router->get('/', callback: function (): void {
    echo 'Hello world!';
});


