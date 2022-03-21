<?php

use app\core\Application;

class m011_create_table_subscriber {
    public function up(){
        $db = Application::$app->db;
        $SQL = "CREATE TABLE `subscriber` (
            `id` int(11) NOT NULL,
            `email` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "DROP TABLE subscriber";
        $db->pdo->exec($SQL);
    }
}