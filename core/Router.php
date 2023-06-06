<?php

namespace app\core;

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
        $callback = $this->routes[$method][$path] ?? function () { echo $this->getErrorScreen(); };

        // Return View
        if (is_string($callback))
        {
            return $this->renderView('main', $callback);
        }

        return call_user_func($callback);
    }

    private function renderView(string $layoutName, string $viewName): bool|string
    {
        $viewContentFile = $_SERVER['DOCUMENT_ROOT'] . '/views/' . $viewName . '.php';

        if (!file_exists($viewContentFile))
        {
            echo $this->getErrorScreen();
            return false;
        }

        $layoutContent = $this->getLayout($layoutName);
        $content = $this->getCleanView($viewName);

        echo str_replace('{{content}}', $content, $layoutContent);

        return true;
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