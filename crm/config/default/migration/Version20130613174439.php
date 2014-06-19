<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130613174439 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
		CREATE TABLE `quiz_user_answer` (
			`campaign_id` INT(11) NOT NULL,
			`quiz_id` INT(11) NOT NULL,
			`user_id` INT(11) NOT NULL,
			`question_id` INT(11) NOT NULL,
			`answer_id` INT(11) NOT NULL DEFAULT '0',
			`create_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY (`campaign_id`, `quiz_id`, `user_id`, `question_id`, `answer_id`)
		)
		COMMENT='Ответы юзеров'
		COLLATE='utf8_general_ci'
		ENGINE=InnoDB;

        ");

    }

    public function down(Schema $schema)
    {
	$this->addSql("
            DROP TABLE `quiz_user_answer`;
        ");

    }
}
