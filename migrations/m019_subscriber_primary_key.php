<?php

use app\core\Application;

class m019_subscriber_primary_key {
    public function up(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `subscriber`ADD PRIMARY KEY (`id`);";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `subscriber` MODIFY `id` INT NOT NULL; 
                ALTER TABLE `subscriber` DROP PRIMARY KEY;";
        $db->pdo->exec($SQL);
    }
}