<?php

use app\core\Application;

class m0004_create_admin_comment_table {
    public function up(){
        $db = Application::$app->db;
        $SQL = "CREATE TABLE `admin_comment` (
            `id` int(11) NOT NULL,
            `comment_id` int(11) NOT NULL,
            `content` varchar(255) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "DROP TABLE admin_comment";
        $db->pdo->exec($SQL);
    }
}