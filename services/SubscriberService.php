<?php

namespace app\services;

use app\model\Subscriber;

class SubscriberService {
    
    public function getSubscribers($orderBy = '', $limit = '')
    {
        $subscriber = new Subscriber();
        return $subscriber->getAll(Subscriber::class, '',   $orderBy, $limit);
    }

    public function deleteSubscriber($where){
        $subscriber = new Subscriber();
        $subscriber::deleteOne($where, Subscriber::class);
    }
}