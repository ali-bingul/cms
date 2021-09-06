<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\Comment;
use app\model\ReplyComment;

class CommentController extends Controller
{
    public function getComments($where = '', $orderBy = '')
    {
        $comment = new Comment();
        return $comment::getAll(Comment::class, $where, $orderBy);
    }

    public function addComment(Request $request, Response $response)
    {
        $comment = new Comment();
        $comment->member_id = $_SESSION['member'];
        $comment->post_title = substr($_SERVER['REQUEST_URI'], 5);
        if($request->isPost()){
            $comment->loadData($request->getBody());
            if($comment->validate() && $comment->save()){
                Application::$app->session->setFlash('success', "You comment it successfully");
                Application::$app->response->redirect($_SERVER['REQUEST_URI']);
                exit;
            }

            header('Location: /cms/');
            // return $this->render('post', [
            //     'model' => $comment
            // ]);
        }
    }

    public function deleteComment($where){
        $comment = new Comment();
        $comment->deleteOne($where, Comment::class);
    }

    public function getReply($where){
        $replyComment = new ReplyComment();
        return $replyComment::findOne($where, ReplyComment::class);
    }

    public function getReplies($where){
        $replyComment = new ReplyComment();
        return $replyComment->getAll(ReplyComment::class, $where);
    }

    public function hasReply($where){
        if($this->getReply($where)){
            return true;
        }
        return false;
    }

    public function deleteReply($where){
        $replyComment = new ReplyComment();
        $replyComment->deleteOne($where, ReplyComment::class);
    }
}
