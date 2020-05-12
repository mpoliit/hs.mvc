<?php


namespace Controllers;


use Core\AbsController;
use Models\Migrate;

class MigrateController extends AbsController
{
    public function migrate()
    {
        $sql_user = "
            CREATE TABLE IF NOT EXISTS `users` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `first_name` VARCHAR(55) NOT NULL,
                `last_name` VARCHAR(55) NOT NULL,
                `email` VARCHAR(155) NOT NULL,
                `pass` TEXT NOT NULL,
                `birthday` DATE NOT NULL,
                `create_at` DATETIME NOT NULL,
                `secret_key` VARCHAR(155) NOT NULL,
                PRIMARY KEY (`id`)
            );
        ";

        $sql_posts = "
            CREATE TABLE IF NOT EXISTS `posts` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `user_id` INT NOT NULL,
                `title` VARCHAR(254) NOT NULL,
                `content` TEXT NOT NULL,
                `image` TEXT NOT NULL,
                `create_at` DATETIME NOT NULL,
                PRIMARY KEY (`id`),
                INDEX `id` (`id`),
                CONSTRAINT `FK__users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
            );
        ";

        $migrate = new Migrate();
        $migrate->migrate($sql_user);
        $migrate->migrate($sql_posts);

        redirect('registration');
    }
}