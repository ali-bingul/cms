<?php

use app\core\Application;

class m015_comment_primary_key {
    public function up(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `comment`
        ADD PRIMARY KEY (`id`),
        ADD KEY `member_id` (`member_id`);";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `comment` MODIFY `id` INT NOT NULL; 
                ALTER TABLE `comment` DROP PRIMARY KEY;";
        $db->pdo->exec($SQL);
    }
}