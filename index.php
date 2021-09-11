<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "init.php";



// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();

// $config = [
//     'memberClass' => Member::class,
//     'adminClass' => Admin::class,
//     'db' => [
//         'dsn' => $_ENV['DB_DSN'],
//         'user' => $_ENV['DB_USER'],
//         'password' => $_ENV['DB_PASSWORD']
//     ]
// ];

// $where = " WHERE active = 1";

// $contentController = new ContentController();
// $categoryController = new CategoryController();

// $app = new Application(__DIR__, $config);

// $app->router->get('/cms/', [SiteController::class, 'home']);
// $app->router->get('/cms/admin', [SiteController::class, 'admin']);


// // content routes
// foreach($contentController->getContents($where) as $content){
//     $app->router->get(sprintf('/cms/%s', Application::slugify($content['title'])), [SiteController::class, 'singlePost']);
//     $app->router->post(sprintf('/cms/%s', Application::slugify($content['title'])), [CommentController::class, 'addComment']);
// }

// $app->router->get('/cms/login', [AuthController::class, 'login']);
// $app->router->post('/cms/login', [AuthController::class, 'login']);
// $app->router->get('/cms/register', [AuthController::class, 'register']);
// $app->router->post('/cms/register', [AuthController::class, 'register']);
// $app->router->get('/cms/logout', [AuthController::class, 'logout']);


// foreach($categoryController->getCategories() as $category){
//     $app->router->get('/cms/categories/' . $category['slug'], [HomeController::class, 'categories']);
// }


// $app->router->get('/cms/contact', [HomeController::class, 'contact']);
// $app->router->post('/cms/contact', [HomeController::class, 'contactMe']);
// $app->router->get('/cms/favorites', [HomeController::class, 'favorites']);
// $app->router->get('/cms/about', [HomeController::class, 'about']);
// $app->router->get('/cms/account', [HomeController::class, 'account']);
// $app->router->post('/cms/account', [MemberController::class, 'updateMember']);


// $app->router->post('/cms/admin', [AuthController::class, 'logout']);
// $app->router->get('/cms/admin/login', [AdminAuthController::class, 'adminlogin']);
// $app->router->get('/cms/admin/logout', [AdminAuthController::class, 'adminLogout']);
// $app->router->post('/cms/admin/login', [AdminAuthController::class, 'adminlogin']);
// $app->router->get('/cms/admin/contents', [AdminController::class, 'contents']);
// $app->router->get('/cms/admin/comments', [AdminController::class, 'comments']);
// $app->router->post('/cms/admin/comments', [AdminController::class, 'replyComment']);
// $app->router->get('/cms/admin/members', [AdminController::class, 'members']);
// $app->router->post('/cms/admin/members', [MemberController::class, 'sendEmailToMember']);
// $app->router->get('/cms/admin/subscribers', [AdminController::class, 'subscribers']);
// $app->router->get('/cms/admin/contents/edit', [AdminController::class, 'editContent']);
// $app->router->get('/cms/admin/contents/new', [AdminController::class, 'addContent']);
// $app->router->post('/cms/admin/contents/new', [AdminController::class, 'addContent']);
// $app->router->get('/cms/admin/account', [AdminController::class, 'account']);
// $app->router->post('/cms/admin/account', [AdminController::class, 'updateAdminAccount']);


// $app->router->post('/cms/', [SubscriberController::class, 'addSubscriber']);


// $app->run();
