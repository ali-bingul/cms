<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    
    use app\controller\SiteController;
    use app\controller\AuthController;
    use app\core\Application;
use app\model\Admin;
use app\model\Member;

    require_once __DIR__ . '/vendor/autoload.php';
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
    $app->db->applyMigrations();
