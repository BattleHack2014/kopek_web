<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130606171229 extends AbstractMigration
{
    public function up(Schema $schema)
    {

        $this->addSql("
            INSERT INTO `admin_user`
            VALUES (NULL, 'syoss@imho.net', '21232f297a57a5a743894a0e4a801fc3', '[\"Dashboard\",\"Administration\",\"Sections\",\"Statistic\"]', '', 'syoss', NULL);
        ");

        $this->addSql("
            INSERT INTO `promo_campaign`
            VALUES (NULL, '1', 'Отзывы пользователей', 'syoss', 'syoss', '', '1', '2013-06-06 00:00:00', '2013-07-07 00:00:00', '2013-06-06 00:00:00');
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DELETE FROM `admin_user` WHERE `login` = 'syoss@imho.net';
        ");
    }
}
