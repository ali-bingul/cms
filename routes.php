<?php
use app\core\Application;
use app\model\Member;
use app\model\Admin;
use Bramus\Router\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'memberClass' => Member::class,
    'adminClass' => Admin::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];
$app = new Application(__DIR__, $config);

$router = new Router();

$router->setNamespace('\app\controller');


$router->get('/', 'SiteController@home');
$router->post('/', 'SubscriberController@addSubscriber');
$router->get("/admin","SiteController@admin");

$router->before('GET|POST', '/admin.*', function() {
    if (!isset($_SESSION['admin'])) {
        header('location: /login/admin');
        exit();
    }
});

$router->before('GET', '/favorites', function() {
    if (!isset($_SESSION['member'])) {
        header('location: /');
        exit();
    }
});

$router->before('GET', '/account', function() {
    if (!isset($_SESSION['member'])) {
        header('location: /');
        exit();
    }
});


$router->get("/categories/{id}","HomeController@categories");
$router->get("/about","HomeController@about");
$router->get("/contact","HomeController@contact");
$router->post("/contact","HomeController@contact");
$router->get("/account","HomeController@account");
$router->post("/account","MemberController@updateMember");
$router->get("/favorites","HomeController@favorites");

$router->get("/post/{id}","SiteController@singlePost");
$router->post("/post/{id}","CommentController@addComment");


$router->get("/admin/members", "AdminController@members");
$router->post("/admin/members", "MemberController@sendEmailToMember");
$router->get("/admin/comments", "AdminController@comments");
$router->post("/admin/comments", "AdminController@replyComment");
$router->get("/admin/contents", "AdminController@contents");
$router->get("/admin/contents/new", "AdminController@addContent");
$router->post("/admin/contents/new", "AdminController@addContent");

$router->get("/admin/subscribers", "AdminController@subscribers");

$router->get("/login/admin","AdminAuthController@adminLogin");
$router->post("/login/admin","AdminAuthController@adminLogin");
$router->get("/admin/logout","AdminAuthController@adminLogout");

$router->get("/admin/contents/edit/{id}", "AdminController@editContent");
$router->post("/admin/contents/edit/{id}", "AdminController@editContent");

$router->get("/admin/account","AdminController@account");
$router->post("/admin/account","AdminController@updateAdminAccount");
$router->get("/admin/subscribers","AdminController@subscriber");


$router->get("/login","AuthController@login");
$router->post("/login","AuthController@login");
$router->get("/register","AuthController@register");
$router->post("/register","AuthController@register");
$router->get("/logout","AuthController@logout");


$router->set404('SiteController@page404');

$router->run();