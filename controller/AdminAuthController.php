<?php

namespace app\controller;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\AdminLoginForm;
use app\core\Application;

class AdminAuthController extends Controller
{
    public function adminlogin()
    {
        $request = new Request();
        $response = new Response();
        $admin = new AdminLoginForm();
        if ($request->isPost()) {
            $admin->loadData($request->getBody());
            if ($admin->validate() && $admin->login()) {
                $response->redirect('/admin');
                return;
            }
        }
        $params = [
            "model" => $admin,
        ];
        echo $this->templates->render("adminlogin", $params);
    }

    public function adminLogout()
    {
        $response = new Response();
        Application::$app->logoutAdmin();
        $response->redirect('/login/admin');
    }
}
