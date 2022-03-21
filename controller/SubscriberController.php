<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\Subscriber;

class SubscriberController extends Controller
{
    public function addSubscriber()
    {
        $request = new Request();
        $response = new Response();
        $subscriber = new Subscriber();
        if ($request->isPost()) {
            $subscriber->loadData($request->getBody());
            if ($subscriber->validate() && $subscriber->save()) {
                Application::$app->session->setFlash('success', "Thanks for subscribe me!");
                return $response->redirect('/');
            }
            $this->setLayout('main');
            return $this->render('/', [
                'model' => $subscriber
            ]);
        }
    }
}
