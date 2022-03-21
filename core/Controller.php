<?php

namespace app\core;

use app\core\Application;
use app\core\middlewares\BaseMiddleware;
use League\Plates\Engine;

class Controller
{
    /**
     * @var \app\core\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];

    public string $layout = "main"; //default layout
    public string $action = '';

    public $templates;
    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../templates');
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }
    
    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddleware(): array
    {
        return $this->middlewares;
    }
}
