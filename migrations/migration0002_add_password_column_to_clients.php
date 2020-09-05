<?php

class migration0002_add_password_column_to_clients {
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $sql = "ALTER TABLE clients ADD COLUMN password VARCHAR(512) NOT NULL;";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $sql = "ALTER TABLE clients DROP COLUMN password;";
        $db->pdo->exec($sql);
    }
}