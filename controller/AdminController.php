<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AdminMiddleware;
use app\core\Request;
use app\model\ContentForm;
use app\core\Response;
use app\model\Admin;
use app\model\ContactForm;
use app\model\replyComment;

class AdminController extends Controller{

    public function __construct() {
        $this->registerMiddleware(new AdminMiddleware(['contents',
        'comments', 'members', 'addContent', 'account', 'addMember' ]));
    }

    public function contents(){
        $this->setLayout('admin');
        return $this->render('admincontents');
    }
    public function comments(){
        $this->setLayout('admin');
        return $this->render('admincomments');
    }
    public function members(){
        $this->setLayout('admin');
        return $this->render('adminmembers');
    }
    public function subscribers(){
        $this->setLayout('admin');
        return $this->render('adminsubscribers');
    }
    public function addContent(Request $request, Response $response){
        $addContent = new ContentForm();
        if($request->isPost()){
            $addContent->loadData($request->getBody());
            if($addContent->validate() && $addContent->save()){
                $addContent->uploadImage(ContentForm::class, ['title' => $addContent->title]);
                $mailController = new MailController();
                $subscriberController = new SubscriberController();
                $mailController->sentMailToSubscribers($subscriberController->getSubscribers(), $addContent);
                Application::$app->session->setFlash('success', "Content successfully uploaded, Mail sended to subscribers");
                return $response->redirect('/cms/admin/contents');
            }
        }
        $this->setLayout('admin');
        return $this->render('adminaddcontent', [
            'model' => $addContent
        ]);
    }

    public function editContent(Request $request, Response $response){
        $addContent = new ContentForm();
        $contentController = new ContentController();
        if($request->isPost()){
            $addContent->loadData($request->getBody());
            if($addContent->validate() && $addContent->update("")){

            }
        }
        $this->setLayout('admin');
        return $this->render('admineditcontent', [
            'model' => $addContent
        ]);
    }


    public function replyComment(Request $request, Response $response){
        $replyComment = new replyComment();
        $this->setLayout('admin');
        if($request->isPost()){
            $replyComment->loadData($request->getBody());
            if($replyComment->validate() && $replyComment->save()){
                Application::$app->session->setFlash('success', "You reply the comment successfully");
                return $response->redirect('/cms/admin/comments');
            }
            return $this->render('admincomments', [
                'model' => $replyComment
            ]);
        }
    }

    public function updateAdminAccount(Request $request, Response $response){
        $admin = new Admin();
        $currentAdmin = $this->getAdmin();
        $oldpassword = $request->getBody()['oldpassword'];
        if($request->isPost()){
            if(password_verify($oldpassword, $currentAdmin->password) && ($admin->password == $admin->confirmPassword)){
                $admin->loadData($request->getBody());
                $admin->password = password_hash($admin->password, PASSWORD_DEFAULT);
                if($admin->validate() && $admin->update(" WHERE id = " .  $_SESSION['admin'])){
                    Application::$app->session->setFlash('success', "You successfully updated your account");
                    Application::$app->response->redirect('/cms/admin/account');
                    exit;
                }
            }
            var_dump('password true but validate not true', $admin->validate(), $admin->errors);
            exit;
            return $this->render('account', [
                'model' => $admin
            ]);
        }
    }

    public function getAdmin(){
        $admin = new Admin();
        return $admin::findOne(['id' => $_SESSION['admin']], Admin::class);
    }

    public function account(){
        $this->setLayout('admin');
        return $this->render('adminaccount');
    }
    public function addMember(){
        $this->setLayout('admin');
        return $this->render('adminaddmember');
    }
}

?>