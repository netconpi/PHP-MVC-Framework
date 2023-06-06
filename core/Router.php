<?php

namespace app\core;

class Router
{
    protected array $routes = [];
    public Request $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function get(string $path, string $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve(): void
    {
        echo $this->request->getPath();
    }

}