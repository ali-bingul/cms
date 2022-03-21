<?php

use app\core\Application;

class m0009_create_member_table {
    public function up(){
        $db = Application::$app->db;
        $SQL = "CREATE TABLE `member` (
            `id` int(11) NOT NULL,
            `username` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "DROP TABLE member";
        $db->pdo->exec($SQL);
    }
}