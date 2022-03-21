<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\Member;
use app\model\LoginForm;

class AuthController extends Controller{

    public function login(){
        $request = new Request();
        $response = new Response();
        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                $response->redirect('/');
                return;
            }
        }
        $params = [
            "model" => $loginForm,
        ];
        echo $this->templates->render("login", $params);
    }


    public function register(){
        $request = new Request();
        $response = new Response();
        $this->setLayout('auth');
        $member = new Member();
        if($request->isPost()){
            $member->loadData($request->getBody());
            if($member->validate() && $member->save()){
                Application::$app->session->setFlash('success', "Thanks for registering");
                Application::$app->response->redirect('/login');
                exit;
            }
            $params = [
                "model" => $member,
            ];
            echo $this->templates->render("register", $params);
        }
        $params = [
            "model" => $member,
        ];
        echo $this->templates->render("register", $params);
    }

    public function logout(){
        $response = new Response();
        Application::$app->logoutMember();
        $response->redirect('/');
    }

    public function updateAccount(){
        $request = new Request();
        $member = new Member();
        if($request->isPost()){
            $member->loadData($request->getBody());
            if($member->validate() && $member->update(['id' => $_SESSION['member']])){
                Application::$app->session->setFlash('success', "Your account has been successfully updated");
                Application::$app->response->redirect('/account');
                exit;
            }
            $params = [
                "model" => $member,
            ];
            echo $this->templates->render("account", $params);
        }
    }
}
?>