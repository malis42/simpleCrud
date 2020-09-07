<?php


class migration0005_add_countries_table
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $sql = "CREATE TABLE `countries` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `country` varchar(255) NOT NULL,
            `phone_prefix` varchar(255) NOT NULL,
            PRIMARY KEY (`id`)
        );";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $sql = "DROP TABLE countries;";
        $db->pdo->exec($sql);
    }
}