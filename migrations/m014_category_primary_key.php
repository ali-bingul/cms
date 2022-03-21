<?php

use app\core\Application;

class m014_category_primary_key {
    public function up(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `category`ADD PRIMARY KEY (`id`);";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `category` MODIFY `id` INT NOT NULL; 
                ALTER TABLE `category` DROP PRIMARY KEY;";
        $db->pdo->exec($SQL);
    }
}