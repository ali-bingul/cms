<?php

use app\core\Application;

class m017_member_primary_key {
    public function up(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `member`ADD PRIMARY KEY (`id`);";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `member` MODIFY `id` INT NOT NULL; 
                ALTER TABLE `member` DROP PRIMARY KEY;";
        $db->pdo->exec($SQL);
    }
}