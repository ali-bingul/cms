<?php

use app\core\Application;

class m0001_initial {
        public function up(){
            $db = Application::$app->db;
            $SQL = "
            CREATE TABLE `member` (
                `id` int(11) NOT NULL,
                `username` varchar(255) NOT NULL,
                `email` varchar(255) NOT NULL,
                `status` TINYINT NOT NULL,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                `password` varchar(255) NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            
            ALTER TABLE `member`
            ADD PRIMARY KEY (`id`);

            ALTER TABLE `member`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
            ";
            $db->pdo->exec($SQL);
        }

        public function down(){
            $db = Application::$app->db;
            $SQL = "
                DROP TABLE member;
            ";
            $db->pdo->exec($SQL);
        }
    }
?>