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

INSERT INTO `promo_campaign_user` (`id`, `campaign_id`, `brand_user_id`, `imhonet_user_id`, `user_key`, `name`, `is_active`, `contacted_at`, `created_at`, `gender`, `age`) VALUES
(1, 1, 1, 1, 'test user key', 'Test User 1', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 22),
(2, 2, 2, 2, 'test user key', 'Test User 2', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 68),
(3, 3, 3, 3, 'test user key', 'Test User 3', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 59),
(4, 4, 4, 4, 'test user key', 'Test User 4', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 28),
(5, 5, 5, 5, 'test user key', 'Test User 5', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 52),
(6, 6, 6, 6, 'test user key', 'Test User 6', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 95),
(7, 7, 7, 7, 'test user key', 'Test User 7', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 98),
(8, 8, 8, 8, 'test user key', 'Test User 8', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 92),
(9, 9, 9, 9, 'test user key', 'Test User 9', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 76),
(10, 10, 10, 10, 'test user key', 'Test User 10', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 18),
(11, 11, 11, 11, 'test user key', 'Test User 11', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 91),
(12, 12, 12, 12, 'test user key', 'Test User 12', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 95),
(13, 13, 13, 13, 'test user key', 'Test User 13', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 91),
(14, 14, 14, 14, 'test user key', 'Test User 14', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 12),
(15, 15, 15, 15, 'test user key', 'Test User 15', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 3),
(16, 16, 16, 16, 'test user key', 'Test User 16', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 33),
(17, 17, 17, 17, 'test user key', 'Test User 17', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 17),
(18, 18, 18, 18, 'test user key', 'Test User 18', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 14),
(19, 19, 19, 19, 'test user key', 'Test User 19', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 25),
(20, 20, 20, 20, 'test user key', 'Test User 20', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 57),
(21, 21, 21, 21, 'test user key', 'Test User 21', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 74),
(22, 22, 22, 22, 'test user key', 'Test User 22', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 67),
(23, 23, 23, 23, 'test user key', 'Test User 23', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 86),
(24, 24, 24, 24, 'test user key', 'Test User 24', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 29),
(25, 25, 25, 25, 'test user key', 'Test User 25', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 53),
(26, 26, 26, 26, 'test user key', 'Test User 26', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 59),
(27, 27, 27, 27, 'test user key', 'Test User 27', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 67),
(28, 28, 28, 28, 'test user key', 'Test User 28', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 81),
(29, 29, 29, 29, 'test user key', 'Test User 29', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 9),
(30, 30, 30, 30, 'test user key', 'Test User 30', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 20),
(31, 31, 31, 31, 'test user key', 'Test User 31', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 82),
(32, 32, 32, 32, 'test user key', 'Test User 32', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 41),
(33, 33, 33, 33, 'test user key', 'Test User 33', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 1),
(34, 34, 34, 34, 'test user key', 'Test User 34', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 70),
(35, 35, 35, 35, 'test user key', 'Test User 35', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 15),
(36, 36, 36, 36, 'test user key', 'Test User 36', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 60),
(37, 37, 37, 37, 'test user key', 'Test User 37', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 15),
(38, 38, 38, 38, 'test user key', 'Test User 38', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 80),
(39, 39, 39, 39, 'test user key', 'Test User 39', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 29),
(40, 40, 40, 40, 'test user key', 'Test User 40', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 85),
(41, 41, 41, 41, 'test user key', 'Test User 41', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 29),
(42, 42, 42, 42, 'test user key', 'Test User 42', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 29),
(43, 43, 43, 43, 'test user key', 'Test User 43', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 61),
(44, 44, 44, 44, 'test user key', 'Test User 44', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 83),
(45, 45, 45, 45, 'test user key', 'Test User 45', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 23),
(46, 46, 46, 46, 'test user key', 'Test User 46', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 42),
(47, 47, 47, 47, 'test user key', 'Test User 47', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 42),
(48, 48, 48, 48, 'test user key', 'Test User 48', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 91),
(49, 49, 49, 49, 'test user key', 'Test User 49', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 11),
(50, 50, 50, 50, 'test user key', 'Test User 50', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 17),
(51, 51, 51, 51, 'test user key', 'Test User 51', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 93),
(52, 52, 52, 52, 'test user key', 'Test User 52', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 35),
(53, 53, 53, 53, 'test user key', 'Test User 53', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 48),
(54, 54, 54, 54, 'test user key', 'Test User 54', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 48),
(55, 55, 55, 55, 'test user key', 'Test User 55', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 49),
(56, 56, 56, 56, 'test user key', 'Test User 56', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 37),
(57, 57, 57, 57, 'test user key', 'Test User 57', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 67),
(58, 58, 58, 58, 'test user key', 'Test User 58', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 61),
(59, 59, 59, 59, 'test user key', 'Test User 59', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 36),
(60, 60, 60, 60, 'test user key', 'Test User 60', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 50),
(61, 61, 61, 61, 'test user key', 'Test User 61', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 3),
(62, 62, 62, 62, 'test user key', 'Test User 62', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 13),
(63, 63, 63, 63, 'test user key', 'Test User 63', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 72),
(64, 64, 64, 64, 'test user key', 'Test User 64', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 48),
(65, 65, 65, 65, 'test user key', 'Test User 65', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 74),
(66, 66, 66, 66, 'test user key', 'Test User 66', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 100),
(67, 67, 67, 67, 'test user key', 'Test User 67', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 7),
(68, 68, 68, 68, 'test user key', 'Test User 68', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 48),
(69, 69, 69, 69, 'test user key', 'Test User 69', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 79),
(70, 70, 70, 70, 'test user key', 'Test User 70', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 63),
(71, 71, 71, 71, 'test user key', 'Test User 71', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 80),
(72, 72, 72, 72, 'test user key', 'Test User 72', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 13),
(73, 73, 73, 73, 'test user key', 'Test User 73', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 84),
(74, 74, 74, 74, 'test user key', 'Test User 74', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 46),
(75, 75, 75, 75, 'test user key', 'Test User 75', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 62),
(76, 76, 76, 76, 'test user key', 'Test User 76', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 35),
(77, 77, 77, 77, 'test user key', 'Test User 77', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 75),
(78, 78, 78, 78, 'test user key', 'Test User 78', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 29),
(79, 79, 79, 79, 'test user key', 'Test User 79', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 87),
(80, 80, 80, 80, 'test user key', 'Test User 80', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 33),
(81, 81, 81, 81, 'test user key', 'Test User 81', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 82),
(82, 82, 82, 82, 'test user key', 'Test User 82', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 66),
(83, 83, 83, 83, 'test user key', 'Test User 83', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 39),
(84, 84, 84, 84, 'test user key', 'Test User 84', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 51),
(85, 85, 85, 85, 'test user key', 'Test User 85', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 60),
(86, 86, 86, 86, 'test user key', 'Test User 86', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 51),
(87, 87, 87, 87, 'test user key', 'Test User 87', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 100),
(88, 88, 88, 88, 'test user key', 'Test User 88', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 89),
(89, 89, 89, 89, 'test user key', 'Test User 89', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 39),
(90, 90, 90, 90, 'test user key', 'Test User 90', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 18),
(91, 91, 91, 91, 'test user key', 'Test User 91', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 13),
(92, 92, 92, 92, 'test user key', 'Test User 92', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 47),
(93, 93, 93, 93, 'test user key', 'Test User 93', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 54),
(94, 94, 94, 94, 'test user key', 'Test User 94', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 56),
(95, 95, 95, 95, 'test user key', 'Test User 95', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 38),
(96, 96, 96, 96, 'test user key', 'Test User 96', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 68),
(97, 97, 97, 97, 'test user key', 'Test User 97', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 83),
(98, 98, 98, 98, 'test user key', 'Test User 98', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'men', 78),
(99, 99, 99, 99, 'test user key', 'Test User 99', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'unknown', 28),
(100, 100, 100, 100, 'test user key', 'Test User 100', 1, '2013-03-01 00:00:00', '2013-03-07 00:00:00', 'women', 7);

INSERT INTO `stat_report` (`id`, `handler`, `title`, `campaign_id`) VALUES
(1, 'UniqueSex', 'Unique sex', 0),
(2, 'UniqueSocialNetwork', 'Auth via Social Networks', 0),
(3, 'Register', 'Register', 0),
(4, 'UniqueAge', 'UniqueAge', 0),
(5, 'UniqueActivity', 'UniqueActivity', 0),
(6, 'UniqueWorks', 'UniqueWorks', 0),
(7, 'UniqueVotes', 'UniqueVotes', 0),
(8, 'UniqueCodes', 'UniqueCodes', 0),
(9, 'TestResults', 'TestResults', 0),
(10, 'WorksStatuses', 'WorksStatuses', 0),
(11, 'WorksRatings', 'WorksRatings', 0),
(12, 'InvitationsStatuses', 'InvitationsStatuses', 0),
(13, 'CodesStatuses', 'CodesStatuses', 0),
(14, 'ContentLikesSocialNetworks', 'ContentLikesSocialNetworks', 0),
(15, 'WinnersByPrize', 'WinnersByPrize', 0),
(16, 'WorksCommentsStatuses', 'WorksCommentsStatuses', 0),
(17, 'RejectionRequests', 'RejectionRequests', 0);

");

    }

    public function down(Schema $schema)
    {
        $this->addSql("

TRUNCATE promo_campaign_user;
TRUNCATE stat_report;

        ");
    }
}
