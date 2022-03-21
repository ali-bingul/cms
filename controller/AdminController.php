<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AdminMiddleware;
use app\core\Request;
use app\model\ContentForm;
use app\core\Response;
use app\model\Admin;
use app\model\replyComment;
use app\services\AdminService;
use app\services\CategoryService;
use app\services\CommentService;
use app\services\ContentService;
use app\services\MailService;
use app\services\MemberService;
use app\services\SubscriberService;

class AdminController extends Controller{

    public function __construct() {
        parent::__construct();
        $this->registerMiddleware(new AdminMiddleware(['contents',
        'comments', 'members', 'addContent', 'account', 'addMember' ]));
    }

    public function contents(){
        $start = 0;
        $limit = 14;
        $where = " WHERE active = 1";
        $limitQuery = " LIMIT " . $start . "," . $limit . ' ';
        $orderBy = " ORDER BY id DESC";
        $contentService = new ContentService();
        $allContentCount = count($contentService->getContents());
        $activeContentCount = count($contentService->getContents(" WHERE active = 1"));
        $passiveContentCount = count($contentService->getContents(" WHERE active = 0"));
        $contents = $contentService->getContents($orderBy, $limitQuery);
        $params = [
            "allContentCount" => $allContentCount,
            "activeContentCount" => $activeContentCount,
            "passiveContentCount" => $passiveContentCount,
            "contents" => $contents,
        ];
        echo $this->templates->render("admincontents", $params);
    }
    public function comments(){
        $start = 0;
        $limit = 14;
        $limitQuery = " LIMIT " . $start . "," . $limit . ' ';
        $orderBy = " ORDER BY id DESC";
        $commentService = new CommentService();
        $memberService = new MemberService();
        $memberCount = count($memberService->getMembers());
        $comments = $commentService->getComments($orderBy, $limitQuery);
        $params = [
            "comments" => $comments,
            "memberCount" => $memberCount,
        ];
        echo $this->templates->render("admincomments", $params);        
    }

    public function members(){
        $start = 0;
        $limit = 14;
        $limitQuery = " LIMIT " . $start . "," . $limit . ' ';
        $orderBy = " ORDER BY id DESC";
        $memberService = new MemberService();
        $memberCount = count($memberService->getMembers());
        $members = $memberService->getMembers($orderBy, $limitQuery);
        $params = [
            "memberCount" => $memberCount,
            "members" => $members,
        ];
        echo $this->templates->render("adminmembers", $params);
    }
    
    public function subscribers(){
        $start = 0;
        $limit = 14;
        $limitQuery = " LIMIT " . $start . "," . $limit . ' ';
        $orderBy = " ORDER BY id DESC";
        $subscriberService = new SubscriberService();
        $subscribers = $subscriberService->getSubscribers($orderBy, $limitQuery);
        $subscriberCount = count($subscriberService->getSubscribers());
        $params = [
            "subscribers" => $subscribers,
            "subscriberCount" => $subscriberCount,
        ];
        echo $this->templates->render("adminsubscribers", $params);        

    }
    public function addContent(){
        $request = new Request();
        $response = new Response();
        $addContent = new ContentForm();
        if($request->isPost()){
            $addContent->loadData($request->getBody());
            $categoryService = new CategoryService();
            $category_id = $categoryService->getCategory(['name' => $addContent->category])->id;
            $addContent->category_id = $category_id;
            if($addContent->validate() && $addContent->save()){
                $addContent->uploadImage(ContentForm::class, ['title' => $addContent->title]);
                $mailService = new MailService();
                $subscriberService = new SubscriberService();
                $mailService->sentMailToSubscribers($subscriberService->getSubscribers(), $addContent);
                Application::$app->session->setFlash('success', "Content successfully uploaded, Mail sended to subscribers");
                return $response->redirect('/admin/contents');
            }
        }
        $categoryService = new CategoryService();
        $categories = $categoryService->getCategories();
        $params = [
            "model" => $addContent,
            "categories" => $categories,
        ];
        echo $this->templates->render("adminaddcontent", $params);        

    }

    public function editContent(){
        $request = new Request();
        $response = new Response();
        $addContent = new ContentForm();
        if($request->isPost()){
            $addContent->loadData($request->getBody());
            if($addContent->validate() && $addContent->update("")){
            }
        }
        $params = [
            "model" => $addContent,
        ];
        echo $this->templates->render("admineditcontent", $params);        
    }

    public function replyComment(){
        $request = new Request();
        $response = new Response();
        $replyComment = new ReplyComment();
        if($request->isPost()){
            $replyComment->loadData($request->getBody());
            var_dump($request->getBody());
            exit;
            if($replyComment->validate() && $replyComment->save()){
                Application::$app->session->setFlash('success', "You reply the comment successfully");
                return $response->redirect('/admin/comments');
            }
            $params = [
                "model" => $replyComment,
            ];
            echo $this->templates->render("admincomments", $params);
        }
    }

    public function updateAdminAccount(){
        $request = new Request();
        $admin = new Admin();
        $adminService = new AdminService();
        $currentAdmin = $adminService->getAdmin();
        $oldpassword = $request->getBody()['oldpassword'];
        if($request->isPost()){
            if(password_verify($oldpassword, $currentAdmin->password) && ($admin->password == $admin->confirmPassword)){
                $admin->loadData($request->getBody());
                $admin->password = password_hash($admin->password, PASSWORD_DEFAULT);
                if($admin->validate() && $admin->update(" WHERE id = " .  $_SESSION['admin'])){
                    Application::$app->session->setFlash('success', "You successfully updated your account");
                    Application::$app->response->redirect('/admin/account');
                    exit;
                }
            }
            var_dump('password true but validate not true', $admin->validate(), $admin->errors);
            exit;
            $params = [
                "model" => $admin,
            ];
            echo $this->templates->render("account", $params);
        }
    }

    public function account(){
        $adminService = new AdminService();
        $admin = $adminService->getAdmin();
        $params = [
            "admin" => $admin,
        ];
        echo $this->templates->render("adminaccount", $params);
    }
}

?>