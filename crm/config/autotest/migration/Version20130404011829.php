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

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;
        ");
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

DROP TABLE IF EXISTS `promo_campaign_code`;
CREATE TABLE IF NOT EXISTS `promo_campaign_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `campaign_user_id` int(10) unsigned DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

        ");
        $this->addSql("

DROP TABLE IF EXISTS `promo_campaign_user`;
CREATE TABLE IF NOT EXISTS `promo_campaign_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` int(10) unsigned NOT NULL,
  `brand_user_id` int(10) unsigned NOT NULL,
  `imhonet_user_id` int(10) unsigned DEFAULT NULL,
  `user_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `contacted_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `gender` enum('men','women','unknown') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unknown',
  `age` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `campaign_user` (`campaign_id`,`imhonet_user_id`,`user_key`),
  KEY `fk_cu_brand_user` (`brand_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=101 ;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `promo_campaign_user_feedback`;
CREATE TABLE IF NOT EXISTS `promo_campaign_user_feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` int(10) unsigned NOT NULL,
  `object_id` int(10) unsigned NOT NULL,
  `feedback_type_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `campaign_user_id` int(10) unsigned NOT NULL,
  `imhonet_user_id` int(10) DEFAULT NULL,
  `user_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value_text` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_type` (`feedback_type_id`),
  KEY `fk_feedback_cu_object` (`object_id`),
  KEY `fk_feedback_parent` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `promo_campaign_user_object`;
CREATE TABLE IF NOT EXISTS `promo_campaign_user_object` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` int(10) unsigned NOT NULL,
  `campaign_user_id` int(10) unsigned NOT NULL,
  `type_id` int(10) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `value_int` int(10) DEFAULT NULL,
  `value_string` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value_text` text COLLATE utf8_unicode_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_object_type` (`type_id`),
  KEY `fk_object_cu` (`campaign_user_id`),
  KEY `fk_object_parent` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `promo_feedback_type`;
CREATE TABLE IF NOT EXISTS `promo_feedback_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


        ");
        $this->addSql("

DROP TABLE IF EXISTS `promo_object_type`;
CREATE TABLE IF NOT EXISTS `promo_object_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `questionnaire`;
CREATE TABLE IF NOT EXISTS `questionnaire` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `status` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `question_answer`;
CREATE TABLE IF NOT EXISTS `question_answer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `score` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `quiz_questions`;
CREATE TABLE IF NOT EXISTS `quiz_questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report`;
CREATE TABLE IF NOT EXISTS `stat_report` (
  `id` smallint(6) NOT NULL,
  `handler` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `campaign_id` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_codes_statuses`;
CREATE TABLE IF NOT EXISTS `stat_report_codes_statuses` (
  `date` date NOT NULL,
  `dimention` enum('Верные','Неверные','Повторные') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_content_likes_social_networks`;
CREATE TABLE IF NOT EXISTS `stat_report_content_likes_social_networks` (
  `date` date NOT NULL,
  `dimention` enum('FB','VK','OK') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_invitations_statuses`;
CREATE TABLE IF NOT EXISTS `stat_report_invitations_statuses` (
  `date` date NOT NULL,
  `dimention` enum('Всего отправлено','Принято','Ожидает') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_register`;
CREATE TABLE IF NOT EXISTS `stat_report_register` (
  `date` date NOT NULL,
  `dimention` enum('Новые','Всего') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_rejection_requests`;
CREATE TABLE IF NOT EXISTS `stat_report_rejection_requests` (
  `date` date NOT NULL,
  `dimention` enum('Отказов от рассылок','Отказов от участия') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_tests_results`;
CREATE TABLE IF NOT EXISTS `stat_report_tests_results` (
  `date` date NOT NULL,
  `dimention` enum('0-10 правильных ответов','11-30 правильных ответов','31-50 правильных ответов') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_unique_activities`;
CREATE TABLE IF NOT EXISTS `stat_report_unique_activities` (
  `date` date NOT NULL,
  `dimention` enum('Отправили работу','Проголосовали','Комментировали','Пригласили друга','Лайкали') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_unique_age`;
CREATE TABLE IF NOT EXISTS `stat_report_unique_age` (
  `date` date NOT NULL,
  `dimention` enum('До 18','18-24','25-34','35-44','45+') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_unique_codes`;
CREATE TABLE IF NOT EXISTS `stat_report_unique_codes` (
  `date` date NOT NULL,
  `dimention` enum('0','1','2','3-10','10+') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_unique_sex`;
CREATE TABLE IF NOT EXISTS `stat_report_unique_sex` (
  `date` date NOT NULL,
  `dimention` enum('Мужчины','Женщины','Неизвестно') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_unique_social_network`;
CREATE TABLE IF NOT EXISTS `stat_report_unique_social_network` (
  `date` date NOT NULL,
  `dimention` enum('FB','VK','OK') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_unique_votes`;
CREATE TABLE IF NOT EXISTS `stat_report_unique_votes` (
  `date` date NOT NULL,
  `dimention` enum('0','1','2-10','11-50','50+') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_unique_works`;
CREATE TABLE IF NOT EXISTS `stat_report_unique_works` (
  `date` date NOT NULL,
  `dimention` enum('0','1','2-5','6-10','10+') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_winners_by_prize`;
CREATE TABLE IF NOT EXISTS `stat_report_winners_by_prize` (
  `date` date NOT NULL,
  `dimention` enum('2 билета','Книга','DVD') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_works_comments_statuses`;
CREATE TABLE IF NOT EXISTS `stat_report_works_comments_statuses` (
  `date` date NOT NULL,
  `dimention` enum('Всего отправлено','Принято','Ожидает') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_works_ratings`;
CREATE TABLE IF NOT EXISTS `stat_report_works_ratings` (
  `date` date NOT NULL,
  `dimention` enum('1','2','3','4','5') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_report_works_statuses`;
CREATE TABLE IF NOT EXISTS `stat_report_works_statuses` (
  `date` date NOT NULL,
  `dimention` enum('Всего отправлено','Опубликовано','Отклонено') NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `period` enum('day','week','month') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`date`,`dimention`,`period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


        ");
        $this->addSql("

DROP TABLE IF EXISTS `stat_unique_user_events`;
CREATE TABLE IF NOT EXISTS `stat_unique_user_events` (
  `user_id` int(10) unsigned NOT NULL,
  `last_events` tinytext NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE IF EXISTS `answers`;
            DROP TABLE IF EXISTS `promo_campaign_code`;
            DROP TABLE IF EXISTS `promo_campaign_user`;
            DROP TABLE IF EXISTS `promo_campaign_user_feedback`;
            DROP TABLE IF EXISTS `promo_campaign_user_object`;
            DROP TABLE IF EXISTS `promo_feedback_type`;
            DROP TABLE IF EXISTS `promo_object_type`;
            DROP TABLE IF EXISTS `questionnaire`;
            DROP TABLE IF EXISTS `questions`;
            DROP TABLE IF EXISTS `question_answer`;
            DROP TABLE IF EXISTS `quiz`;
            DROP TABLE IF EXISTS `quiz_questions`;
            DROP TABLE IF EXISTS `stat_report`;
            DROP TABLE IF EXISTS `stat_report_codes_statuses`;
            DROP TABLE IF EXISTS `stat_report_content_likes_social_networks`;
            DROP TABLE IF EXISTS `stat_report_invitations_statuses`;
            DROP TABLE IF EXISTS `stat_report_register`;
            DROP TABLE IF EXISTS `stat_report_rejection_requests`;
            DROP TABLE IF EXISTS `stat_report_tests_results`;
            DROP TABLE IF EXISTS `stat_report_unique_activities`;
            DROP TABLE IF EXISTS `stat_report_unique_age`;
            DROP TABLE IF EXISTS `stat_report_unique_codes`;
            DROP TABLE IF EXISTS `stat_report_unique_sex`;
            DROP TABLE IF EXISTS `stat_report_unique_social_network`;
            DROP TABLE IF EXISTS `stat_report_unique_votes`;
            DROP TABLE IF EXISTS `stat_report_unique_works`;
            DROP TABLE IF EXISTS `stat_report_winners_by_prize`;
            DROP TABLE IF EXISTS `stat_report_works_comments_statuses`;
            DROP TABLE IF EXISTS `stat_report_works_ratings`;
            DROP TABLE IF EXISTS `stat_report_works_statuses`;
            DROP TABLE IF EXISTS `stat_unique_user_events`;
        ");

    }
}
