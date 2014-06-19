<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130601174121 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE `promo_campaign` ADD `thumb_url` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `description`;
        ");

        $this->addSql("
            ALTER TABLE `admin_user` CHANGE `current_promo_id` `current_campaign_id` SMALLINT( 5 ) UNSIGNED NULL DEFAULT NULL;
        ");

        $this->addSql("
            INSERT INTO `promo_campaign` (`id`, `brand_id`, `title`, `code`, `description`, `is_active`, `start_date`, `end_date`, `created_at`)
            VALUES ('2', '1', 'Рок волна', 'cinema', 'cinema', '1', '2013-05-10 00:00:00', '2013-07-25 00:00:00', '2013-05-10 00:00:00');
        ");

        $this->addSql("
            UPDATE `promo_campaign` SET `title` = 'Фотоконкурс' WHERE `promo_campaign`.`id` = 1 LIMIT 1
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE `promo_campaign` DROP `thumb_url`;
        ");

        $this->addSql("
            ALTER TABLE `admin_user` CHANGE `current_campaign_id` `current_promo_id` SMALLINT( 5 ) UNSIGNED NULL DEFAULT NULL;
        ");

        $this->addSql("
            DELETE FROM `promo_campaign` WHERE id = 2;
        ");
    }
}
