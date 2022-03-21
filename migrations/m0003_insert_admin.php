<?php

use app\core\Application;

class m0003_insert_admin {
    public function up(){
        $db = Application::$app->db;
        $username = 'admin';
        $passwordHash = password_hash('admin123', PASSWORD_DEFAULT);
        $SQL = "INSERT INTO `admin` (`id`, `username`, `password`) VALUES
            (1, '$username', '$passwordHash');";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "TRUNCATE TABLE admin";
        $db->pdo->exec($SQL);
    }
}