<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130404013204 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("

INSERT INTO `admin_user` (`id`, `login`, `password`, `resources`, `remember_hash`, `project`, `current_promo_id`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '[\"Dashboard\",\"Administration\",\"Sections\",\"Statistic\"]', '51c8e79d8be4d572a5e03b04136cb843', 'cinema', 2),
(2, 'user@imho.net', 'ee11cbb19052e40b07aac0ca060c23ee', '[\"Dashboard\",\"Sections\",\"Statistic\"]', NULL, 'cinema', NULL),
(3, 'admin@imho.net', '21232f297a57a5a743894a0e4a801fc3', '[\"Dashboard\",\"Administration\",\"Sections\",\"Statistic\"]', NULL, 'cinema', NULL),
(4, 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '[\"Dashboard\",\"Sections\",\"Statistic\"]', 'e5506d1ed7ce72b883a584488ddc294c', 'cinema', 1),
(5, 'autotest@imho.net', '495631893584adfdcdb2d1f52c03c52f', '[\"Dashboard\",\"Administration\",\"Sections\",\"Statistic\"]', NULL, 'autotest', 1);

");

    }

    public function down(Schema $schema)
    {
        $this->addSql("

TRUNCATE admin_user;

        ");
    }
}
