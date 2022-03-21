<?php

use app\core\Application;

class m0007_create_comment_table {
    public function up(){
        $db = Application::$app->db;
        $SQL = "CREATE TABLE `comment` (
            `id` int(11) NOT NULL,
            `member_id` int(11) NOT NULL,
            `content` text NOT NULL,
            `post_id` int(11) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "DROP TABLE comment";
        $db->pdo->exec($SQL);
    }
}