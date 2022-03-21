<?php

use app\core\Application;

class m0008_create_favorites_table {
    public function up(){
        $db = Application::$app->db;
        $SQL = "CREATE TABLE `favorites` (
            `id` int(11) NOT NULL,
            `member_id` int(11) NOT NULL,
            `post_id` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "DROP TABLE favorites";
        $db->pdo->exec($SQL);
    }
}