<?php

use app\core\Application;

class m0010_create_post_table {
    public function up(){
        $db = Application::$app->db;
        $SQL = "CREATE TABLE `post` (
            `id` int(11) NOT NULL,
            `title` varchar(255) NOT NULL,
            `content` text NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `image` text,
            `category` varchar(255) NOT NULL,
            `category_id` int(11) NOT NULL DEFAULT '1',
            `active` tinyint(1) NOT NULL DEFAULT '1'
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "DROP TABLE post";
        $db->pdo->exec($SQL);
    }
}