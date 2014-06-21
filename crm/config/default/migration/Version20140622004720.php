<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140622004720 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            DROP TABLE IF EXISTS `goal`;
            CREATE TABLE IF NOT EXISTS `goal` (
              `id` int(11) NOT NULL,
              `user_id` int(11) DEFAULT NULL,
              `title` varchar(45) DEFAULT NULL,
              `description` text,
              `amount` int(11) DEFAULT NULL,
              `expiration_date` timestamp NULL DEFAULT NULL,
              `start_date` timestamp NULL DEFAULT NULL,
              `status` enum('CANCELED','IN_PROGRESS','DRAFT','VOTING','WINNER_FRIENDS','WINNER_USER') DEFAULT NULL,
              `preapproval_key` varchar(45) DEFAULT NULL,
              `is_paid` tinyint(1) DEFAULT NULL,
              PRIMARY KEY (`id`),
              KEY `user_id` (`user_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
        $this->addSql("
            DROP TABLE IF EXISTS `goal_member`;
            CREATE TABLE IF NOT EXISTS `goal_member` (
              `id` int(11) NOT NULL,
              `user_id` int(11) DEFAULT NULL,
              `goal_id` int(11) DEFAULT NULL,
              `amount` int(11) DEFAULT NULL,
              `date` timestamp NULL DEFAULT NULL,
              `preapproval_key` varchar(45) DEFAULT NULL,
              `vote` enum('YES','NO','UNKNOWN') DEFAULT NULL,
              `bid` enum('YES','NO','UNKNOWN') DEFAULT NULL,
              PRIMARY KEY (`id`),
              KEY `user_id` (`user_id`),
              KEY `goal_id` (`goal_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
        $this->addSql("
            DROP TABLE IF EXISTS `user`;
            CREATE TABLE IF NOT EXISTS `user` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(45) DEFAULT NULL,
              `paypal_email` varchar(45) DEFAULT NULL,
              `email` varchar(45) DEFAULT NULL,
              `fb_token` varchar(45) DEFAULT NULL,
              `fb_id` varchar(45) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
        ");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
