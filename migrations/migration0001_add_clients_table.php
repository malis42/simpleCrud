<?php

class migration0001_add_clients_table {
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $sql = "CREATE TABLE clients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $sql = "DROP TABLE clients;";
        $db->pdo->exec($sql);
    }
}