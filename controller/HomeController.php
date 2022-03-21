<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\HomeMiddleware;
use app\core\Request;
use app\core\Response;
use app\model\ContactForm;
use app\services\CategoryService;
use app\services\ContentService;
use app\services\FavoritesService;
use app\services\MailService;
use app\services\MemberService;

class HomeController extends Controller{

    public function __construct() {
        parent::__construct();
        $this->registerMiddleware(new HomeMiddleware(['account', 'favorites']));
    }

    public function categories($id){
        $start = 0;
        $limit = 14;
        $whereQuery = " WHERE active = 1 AND category_id = '" . $id . "'";
        $orderBy = " ORDER BY id DESC";
        $limitQuery = " LIMIT " . $start . "," . $limit . ' ';
        $categoryService = new CategoryService();
        $contentService = new ContentService();
        $contents = $contentService->getContents($whereQuery, $orderBy, $limitQuery);
        $category = $categoryService->getCategory(['id' => $id]);
        $contentCount = count($contentService->getContents($whereQuery));
        $params = [
            "category" => $category,
            "contents" => $contents,
            "contentCount" => $contentCount,
        ];
        echo $this->templates->render("categorypost", $params);
    }
    public function contact(){
        echo $this->templates->render("contact");
    }
    public function contactMe(Request $request, Response $response){
        $contactForm = new ContactForm();
        if($request->isPost()){
            $contactForm->loadData($request->getBody());
            if($contactForm->validate()){
                $mailService = new MailService();
                $result = $mailService->sentMailToAdmin($contactForm->name, $contactForm->email, $contactForm->website, $contactForm->body);
                if($result == true){
                    $msg = "Thanks for contacting me!";
                }
                else {
                    $msg = "A problem has occurs!";
                }
                Application::$app->session->setFlash('success', $msg);
                return $response->redirect('/contact');
            }
            return $this->render('contact', [
                'model' => $contactForm
            ]);
        }
    }
    public function favorites(){
        $start = 0;
        $limit = 14;
        $whereQuery = " WHERE active = 1";
        $orderBy = " ORDER BY id DESC";
        $limitQuery = " LIMIT " . $start . "," . $limit . ' ';
        $favoritesService = new FavoritesService();
        $contentService = new ContentService();
        $favoritesCount = count($favoritesService->getFavorites(" WHERE member_id = " . $_SESSION['member']));
        $favorites = $favoritesService->getFavorites(" WHERE member_id = " . $_SESSION['member']);
        $contentCount = count($contentService->getContents($whereQuery));
        $params = [
            "favoritesCount" => $favoritesCount,
            "favorites" => $favorites,
            "contentCount" => $contentCount,
        ];
        echo $this->templates->render("favorites", $params);
    }
    public function about(){
        echo $this->templates->render("about");
    }
    public function account(){
        $memberService = new MemberService();
        $member = $memberService->getMember(['id' => $_SESSION['member']]);
        $params = [
            "member" => $member,
        ];
        echo $this->templates->render("account", $params);
    }
}


?>