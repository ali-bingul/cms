<?php

use app\core\Application;

class m026_post_auto_increment {
    public function up(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `post`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "ALTER TABLE `post` MODIFY id int(11);";
        $db->pdo->exec($SQL);
    }
}