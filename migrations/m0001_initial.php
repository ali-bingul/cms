<?php

use app\core\Application;

class m0001_initial {
    public function up(){
        $db = Application::$app->db;
        $SQL = "CREATE DATABASE IF NOT EXISTS cms ";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "DROP DATABASE IF EXISTS cms";
        $db->pdo->exec($SQL);
    }
}
?>