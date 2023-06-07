<?php

namespace app\controllers;

use app\core\Application;

class SiteController
{
    public function handleContact(): string
    {
        return 'Handling submitted data: ';
    }

    public function contact(): string
    {
        return Application::$app->router->renderView('main', 'contacts');
    }

    public function main(): string
    {
        return Application::$app->router->renderView('main', 'home', ['name'=>'test mvc site']);
    }
}