<?php

namespace app\controllers;

class SiteController
{
    public function handleContact(): string
    {
        return 'Handling submitted data: ';
    }

    public function contact(): string
    {
        return 'Serving view: ';
    }
}