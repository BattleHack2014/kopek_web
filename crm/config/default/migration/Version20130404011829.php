<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130404011829 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `resources` varchar(255) NOT NULL,
  `remember_hash` varchar(255) DEFAULT NULL,
  `project` varchar(255) NOT NULL,
  `current_promo_id` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE IF EXISTS `admin_user`;
        ");

    }
}
