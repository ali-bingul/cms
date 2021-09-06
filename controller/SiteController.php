<?php

namespace app\controller;
use app\core\Controller;
use app\core\middlewares\AdminMiddleware;

class SiteController extends Controller{

    public function __construct() {
        $this->registerMiddleware(new AdminMiddleware(['admin']));
    }

    public function admin(){
        $this->setLayout('admin');
        $params = [
            "name" => "Ali Bingül"
        ];
        // return Application::$app->router->renderView('home', $params);
        return $this->render('admin', $params);
    }

    public function home(){
        $this->setLayout('main');
        return $this->render('home');
    }

    public function singlePost(){
        $this->setLayout('main');
        return $this->render('post');
    }
}

?>