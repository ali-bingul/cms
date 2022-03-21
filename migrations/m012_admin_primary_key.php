<?php

use app\core\Application;

class m012_admin_primary_key {
    public function up(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `admin`ADD PRIMARY KEY (`id`);";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `admin` MODIFY `id` INT NOT NULL; 
                ALTER TABLE `admin` DROP PRIMARY KEY;";
        $db->pdo->exec($SQL);
    }
}