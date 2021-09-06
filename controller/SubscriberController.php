<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\Subscriber;

class SubscriberController extends Controller
{
    public function getSubscribers($orderBy = '', $limit = '')
    {
        $subscriber = new Subscriber();
        return $subscriber->getAll(Subscriber::class, '',   $orderBy, $limit);
    }

    public function addSubscriber(Request $request, Response $response)
    {
        $subscriber = new Subscriber();
        if ($request->isPost()) {
            $subscriber->loadData($request->getBody());
            if ($subscriber->validate() && $subscriber->save()) {
                Application::$app->session->setFlash('success', "Thanks for subscribe me!");
                return $response->redirect('/cms/');
            }
            $this->setLayout('main');
            return $this->render('/cms/', [
                'model' => $subscriber
            ]);
        }
    }

    public function deleteSubscriber($where){
        $subscriber = new Subscriber();
        $subscriber::deleteOne($where, Subscriber::class);
    }
}
