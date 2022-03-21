<?php

namespace app\controller;
use app\core\Controller;
use app\core\middlewares\AdminMiddleware;
use app\services\CommentService;
use app\services\ContentService;
use app\services\MemberService;
use app\services\SubscriberService;

class SiteController extends Controller{

    public function __construct() {
        parent::__construct();
        $this->registerMiddleware(new AdminMiddleware(['admin']));
    }

    public function admin(){
        $memberService = new MemberService();
        $contentService = new ContentService();
        $commentService = new CommentService();
        $subscriberService = new SubscriberService();
        $memberCount = count($memberService->getMembers());
        $contentCount = count($contentService->getContents());
        $commentCount = count($commentService->getComments());
        $subscriberCount = count($subscriberService->getSubscribers());
        $params = [
            "name" => "Ali Bingül",
            "memberCount" => $memberCount,
            "contentCount" => $contentCount,
            "commentCount" => $commentCount,
            "subscriberCount" => $subscriberCount,
        ];
        echo $this->templates->render('admin', $params);
    }

    public function home(){
        $start = 0;
        $limit = 14;
        $whereQuery = " WHERE active = 1";
        $orderBy = " ORDER BY id DESC";
        $limitQuery = " LIMIT " . $start . "," . $limit . ' ';
        $contentService = new ContentService();
        $contents = $contentService->getContents($whereQuery, $orderBy, $limitQuery);
        $activeContentCount = count($contentService->getContents($whereQuery));
        $params = [
            "contents" => $contents,
            "activeContentCount" => $activeContentCount,
        ];
        echo $this->templates->render("home", $params);
    }

    public function singlePost($id){
        $whereQuery = " WHERE post_id = " . "'" . $id . "'";
        $orderBy = " ORDER BY created_at DESC";
        $contentService = new ContentService();
        $commentService = new CommentService();
        $content = $contentService->getContent(['id' => $id]);
        $commentsCount = count($commentService->getComments($whereQuery, $orderBy));
        $comments = $commentService->getComments($whereQuery, $orderBy);
        $params = [
            "content" => $content,
            "commentsCount" => $commentsCount,
            "comments" => $comments,
        ];
        echo $this->templates->render("post", $params);
    }

    public function page404(){
        echo $this->templates->render("404");
    }
}
