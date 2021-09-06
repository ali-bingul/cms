<?php

namespace app\controller;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\AdminLoginForm;
use app\core\Application;

class AdminAuthController extends Controller
{
    public function adminlogin(Request $request, Response $response)
    {
        $this->setLayout('auth');
        $admin = new AdminLoginForm();
        if ($request->isPost()) {
            $admin->loadData($request->getBody());
            if ($admin->validate() && $admin->login()) {
                $response->redirect('/cms/admin');
                return;
            }
        }
        return $this->render('adminlogin', [
            'model' => $admin
        ]);
    }

    public function adminLogout(Request $request, Response $response)
    {
        Application::$app->logoutAdmin();
        $response->redirect('/cms/admin/login');
        // session_destroy();
    }
}
