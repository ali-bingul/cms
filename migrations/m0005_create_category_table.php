<?php

use app\core\Application;

class m0005_create_category_table {
    public function up(){
        $db = Application::$app->db;
        $SQL = "CREATE TABLE `category` (
            `id` int(11) NOT NULL,
            `name` varchar(255) NOT NULL,
            `slug` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "DROP TABLE category";
        $db->pdo->exec($SQL);
    }
}