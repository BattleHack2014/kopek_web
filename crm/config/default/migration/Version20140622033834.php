<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140622033834 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE  `goal` CHANGE  `status`  `status` ENUM(  'CANCELED',  'IN_PROGRESS',  'DRAFT',  'VOTING',  'WINNER_FRIENDS',  'WINNER_USER',  'NEW' ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
