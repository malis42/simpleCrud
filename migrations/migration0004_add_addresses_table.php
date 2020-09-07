<?php


class migration0004_add_addresses_table
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $sql = "CREATE TABLE `addresses` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `country_id` int(11) NOT NULL,
            `city` varchar(255) NOT NULL,
            `zip_code` varchar(255) NOT NULL,
            `address_line_1` varchar(255) NOT NULL,
            `address_line_2` varchar(255) NOT NULL,
            PRIMARY KEY (`id`)
        );";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $sql = "DROP TABLE addresses;";
        $db->pdo->exec($sql);
    }
}