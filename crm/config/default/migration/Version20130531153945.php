<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130531153945 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("

DROP TABLE IF EXISTS `promo_campaign` ;

CREATE  TABLE IF NOT EXISTS `promo_campaign` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `brand_id` INT(10) UNSIGNED NOT NULL ,
  `title` VARCHAR(255) NOT NULL ,
  `code` VARCHAR(255) NOT NULL ,
  `description` TEXT NOT NULL ,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1 ,
  `start_date` DATETIME NOT NULL ,
  `end_date` DATETIME NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_campaign_brand` (`brand_id` ASC) )
ENGINE = InnoDB;

        ");

        $this->addSql("
            INSERT INTO `promo_campaign` (`id`, `brand_id`, `title`, `code`, `description`, `is_active`, `start_date`, `end_date`, `created_at`)
            VALUES ('1', '1', 'cinema', 'cinema', 'cinema', '1', '2013-05-01 00:00:00', '2013-06-30 00:00:00', '2013-05-01 00:00:00');
        ");

    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE IF EXISTS `promo_campaign` ;
        ");
    }
}
