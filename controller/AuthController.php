<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\Member;
use app\model\LoginForm;
use app\core\middlewares\HomeMiddleware;

class AuthController extends Controller{

    public function login(Request $request, Response $response){
        $this->setLayout('auth');
        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                $response->redirect('/cms/');
                return;
            }
        }
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }


    public function register(Request $request){
        $this->setLayout('auth');
        $member = new Member();
        if($request->isPost()){
            $member->loadData($request->getBody());
            if($member->validate() && $member->save()){
                Application::$app->session->setFlash('success', "Thanks for registering");
                Application::$app->response->redirect('/cms/login');
                exit;
            }
            return $this->render('register', [
                "model" => $member
            ]);
        }
        return $this->render('register', [
            "model" => $member
        ]);
    }

    public function logout(Request $request, Response $response){
        Application::$app->logoutMember();
        $response->redirect('/cms/');
    }

    public function updateAccount(Request $request){
        $member = new Member();
        if($request->isPost()){
            $member->loadData($request->getBody());
            if($member->validate() && $member->update(['id' => $_SESSION['member']])){
                Application::$app->session->setFlash('success', "Your account has been successfully updated");
                Application::$app->response->redirect('/cms/account');
                exit;
            }
            return $this->render('account', [
                'model' => $member
            ]);
        }
    }

    
}
?>