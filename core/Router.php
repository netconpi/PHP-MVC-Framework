<?php

namespace app\core;

use app\controllers\SiteController;

class Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get(string $path, mixed $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, mixed $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve(): mixed
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? function () { return $this->getErrorScreen(); };

        // Return View
        if (is_string($callback))
        {
            return $this->renderView('main', $callback);
        }

//        var_dump($callback);
        return call_user_func($callback);
//        return call_user_func([new SiteController(), 'contact']);
    }

    public function renderView(string $layoutName, string $viewName): string
    {
        $viewContentFile = $_SERVER['DOCUMENT_ROOT'] . '/views/' . $viewName . '.php';

        if (!file_exists($viewContentFile))
        {
            return $this->getErrorScreen();
        }

        $layoutContent = $this->getLayout($layoutName);
        $content = $this->getCleanView($viewName);

        return str_replace('{{content}}', $content, $layoutContent);
    }

    private function getLayout(string $layoutName): string
    {
        ob_start();
        include_once $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/' . $layoutName . '.php';
        return ob_get_clean();
    }

    private function getCleanView(string $viewName): string
    {
        ob_start();
        include_once $_SERVER['DOCUMENT_ROOT'] . '/views/' . $viewName . '.php';
        return ob_get_clean();
    }

    private function getErrorScreen(): string
    {
        ob_start();
        include_once $_SERVER['DOCUMENT_ROOT'] . '/views/404.php';
        $this->response->setResponseCode(404);
        return ob_get_clean();
    }

}