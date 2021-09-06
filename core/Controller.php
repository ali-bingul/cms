<?php
namespace app\core;
use app\core\Application;
use app\core\middlewares\BaseMiddleware;

class Controller {

    // default layout
    public string $layout = 'main';
    public string $action = '';

    /** 
     * @var \app\core\middlewares\BaseMiddleware[]
    */
    protected array $middlewares = [];
    
    // render view from router function
    public function render($view, $params=[]){
        // return Application::$app->router->renderView($view, $params);
        return Application::$app->view->renderView($view, $params);
    }

    // set layout of content
    public function setLayout($layout){
        $this->layout = $layout;
    }

    public function registerMiddleware(BaseMiddleware $middleware){
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array{
        return $this->middlewares;
    }
}

?>