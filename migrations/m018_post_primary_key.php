<?php

use app\core\Application;

class m018_post_primary_key {
    public function up(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `post`ADD PRIMARY KEY (`id`);";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `post` MODIFY `id` INT NOT NULL; 
                ALTER TABLE `post` DROP PRIMARY KEY;";
        $db->pdo->exec($SQL);
    }
}