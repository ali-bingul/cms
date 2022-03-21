<?php

use app\core\Application;

class m016_favorites_primary_key {
    public function up(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `favorites`ADD PRIMARY KEY (`id`);";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `favorites` MODIFY `id` INT NOT NULL; 
                ALTER TABLE `favorites` DROP PRIMARY KEY;";
        $db->pdo->exec($SQL);
    }
}