<?php

use app\core\Application;

class m013_admin_comment_primary_key {
    public function up(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `admin_comment`ADD PRIMARY KEY (`id`);";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `admin_comment` MODIFY `id` INT NOT NULL; 
                ALTER TABLE `admin_comment` DROP PRIMARY KEY;";
        $db->pdo->exec($SQL);
    }
}