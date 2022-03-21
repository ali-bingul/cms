<?php

use app\core\Application;

class m020_admin_auto_increment {
    public function up(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `admin`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `admin` MODIFY id int(11);";
        $db->pdo->exec($SQL);
    }
}