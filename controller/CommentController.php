<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\Comment;

class CommentController extends Controller{

    public function addComment($id)
    {
        $request = new Request();
        $response = new Response();
        $comment = new Comment();
        $comment->member_id = $_SESSION['member'];
        $comment->post_id = $id;
        if($request->isPost()){
            $comment->loadData($request->getBody());
            if($comment->validate() && $comment->save()){
                Application::$app->session->setFlash('success', "You comment it successfully");
                Application::$app->response->redirect($_SERVER['REQUEST_URI']);
                exit;
            }
            header('Location: /');
        }
    }
}