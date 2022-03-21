<?php

namespace app\services;

use app\core\Application;
use app\core\Request;
use app\core\Response;
use app\model\Comment;
use app\model\ReplyComment;

class CommentService{
    public function getComments($where = '', $orderBy = '')
    {
        $comment = new Comment();
        return $comment::getAll(Comment::class, $where, $orderBy);
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