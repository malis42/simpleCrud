<?php

class migration0003_add_user_table
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $sql = "CREATE TABLE `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `first_name` varchar(255) NOT NULL,
            `last_name` varchar(255) NOT NULL,
            `phone_number` varchar(255) NOT NULL, 
            `address_id` int(11) NOT NULL,
            PRIMARY KEY (`id`)
        );";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $sql = "DROP TABLE users;";
        $db->pdo->exec($sql);
    }
}