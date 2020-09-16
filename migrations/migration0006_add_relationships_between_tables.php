<?php


class migration0006_add_relationships_between_tables
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $sql = "ALTER TABLE `addresses` ADD CONSTRAINT `addresses_fk0` FOREIGN KEY (`country_id`) REFERENCES `countries`(`id`);

        ALTER TABLE `users` ADD CONSTRAINT `users_fk0` FOREIGN KEY (`address_id`) REFERENCES `addresses`(`id`);
        
        ALTER TABLE `phone_numbers` ADD CONSTRAINT `phone_numbers_fk0` FOREIGN KEY (`country_id`) REFERENCES `countries`(`id`);
        
        ALTER TABLE `phone_numbers` ADD CONSTRAINT `phone_numbers_fk1` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);";
        $db->pdo->exec($sql);
    }
}