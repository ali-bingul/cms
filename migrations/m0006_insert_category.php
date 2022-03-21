<?php

use app\core\Application;

class m0006_insert_category {
    public function up(){
        $db = Application::$app->db;
        $SQL = "INSERT INTO `category` (`id`, `name`, `slug`) VALUES
        (1, 'Management', 'management'),
        (2, 'Programming', 'programming'),
        (3, 'Space', 'space'),
        (4, 'Hardware Engineering', 'hardware-engineering'),
        (5, 'Lifestyle', 'lifestyle'),
        (6, 'Cyber Security', 'cyber-security'),
        (7, 'Computer Science', 'computer-science');";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = Application::$app->db;
        $SQL = "TRUNCATE TABLE category";
        $db->pdo->exec($SQL);
    }
}