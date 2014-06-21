<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140622033206 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE  `goal` CHANGE  `id`  `id` INT( 11 ) NOT NULL AUTO_INCREMENT ;");
        $this->addSql("ALTER TABLE  `goal_member` CHANGE  `id`  `id` INT( 11 ) NOT NULL AUTO_INCREMENT ;");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
