<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\HomeMiddleware;
use app\core\Request;
use app\core\Response;
use app\model\ContactForm;

class HomeController extends Controller{

    public function __construct() {
        $this->registerMiddleware(new HomeMiddleware(['account', 'favorites']));
    }

    public function categories(){
        $this->setLayout('main');
        return $this->render('categorypost');
    }
    public function contact(){
        $this->setLayout('main');
        return $this->render('contact');
    }
    public function contactMe(Request $request, Response $response){
        $contactForm = new ContactForm();
        if($request->isPost()){
            $contactForm->loadData($request->getBody());
            if($contactForm->validate()){
                $mailController = new MailController();
                $result = $mailController->sentMailToAdmin($contactForm->name, $contactForm->email, $contactForm->website, $contactForm->body);
                if($result == true){
                    $msg = "Thanks for contacting me!";
                }
                else {
                    $msg = "A problem has occurs!";
                }
                Application::$app->session->setFlash('success', $msg);
                return $response->redirect('/cms/contact');
            }
            return $this->render('contact', [
                'model' => $contactForm
            ]);
        }
    }
    public function favorites(){
        $this->setLayout('main');
        return $this->render('favorites');
    }
    public function about(){
        $this->setLayout('main');
        return $this->render('about');
    }
    public function account(){
        $this->setLayout('main');
        return $this->render('account');
    }
}


?>