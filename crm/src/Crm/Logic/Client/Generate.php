<?php
namespace Crm\Logic\Client;

use Tool\SocialNetwork;

use Ers\Reader\Handler\RejectionRequests;

use Ers\Reader\Handler\WorksCommentsStatuses;

use Ers\Reader\Handler\WinnersByPrize;

use Ers\Reader\Handler\ContentLikesSocialNetworks;

use Ers\Reader\Handler\CodesStatuses;

use Ers\Reader\Handler\InvitationsStatuses;

use Ers\Reader\Handler\WorksRatings;

use Ers\Reader\Handler\WorksStatuses;

use Ers\Reader\Handler\TestsResults;

use Ers\Reader\Handler\UniqueCodes;

use Ers\Reader\Handler\UniqueVotes;

use Ers\Reader\Handler\UniqueWorks;

use Crm\Logic\Logic;
use Crm\Logic\AuthLogic;
use Ers\Reader\Handler\Register;
use Ers\Reader\Handler\UniqueSex;
use Ers\Reader\Handler\UniqueAge;
use Ers\Reader\Handler\UniqueSocialNetwork;
use Ers\Reader\Handler\UniqueActivities;

class Generate extends Logic {

    public function actionGo() {
        $reports = array(
            Register::TABLE => array(
                Register::TIME_NEW, Register::TIME_TOTAL
            ),
            UniqueSex::TABLE => array(
                UniqueSex::SEX_MEN, UniqueSex::SEX_WOMEN, UniqueSex::SEX_UNKNOWN,
            ),
            UniqueAge::TABLE => array(
                UniqueAge::AGE_BEFORE_18, UniqueAge::AGE_18_24, UniqueAge::AGE_25_34, UniqueAge::AGE_35_44, UniqueAge::AGE_MORE_45
            ),
            UniqueSocialNetwork::TABLE => array(
                SocialNetwork::FB, SocialNetwork::OK, SocialNetwork::VK,
            ),
            UniqueActivities::TABLE => array(
                UniqueActivities::WORK_ADD, UniqueActivities::VOTE_ADD, UniqueActivities::COMMENT_ADD, UniqueActivities::FRIEND_ADD, UniqueActivities::LIKE_ADD
            ),
            UniqueWorks::TABLE => array(
                UniqueWorks::WORKS_ZERO, UniqueWorks::WORKS_ONE, UniqueWorks::WORKS_2_5, UniqueWorks::WORKS_6_10, UniqueWorks::WORKS_MORE_10
            ),
            UniqueVotes::TABLE => array(
                UniqueVotes::VOTES_ZERO, UniqueVotes::VOTES_ONE, UniqueVotes::VOTES_2_10, UniqueVotes::VOTES_11_50, UniqueVotes::VOTES_MORE_50
            ),
            UniqueCodes::TABLE => array(
                UniqueCodes::CODES_ZERO, UniqueCodes::CODES_ONE, UniqueCodes::CODES_2, UniqueCodes::CODES_3_10, UniqueCodes::CODES_MORE_10
            ),
            TestsResults::TABLE => array(
                TestsResults::RESULT_0_10, TestsResults::RESULT_11_30, TestsResults::RESULT_31_50
            ),
            WorksStatuses::TABLE => array(
                WorksStatuses::SENT, WorksStatuses::APPROVED, WorksStatuses::REJECTED
            ),
            WorksRatings::TABLE => array(
                WorksRatings::RATING_1, WorksRatings::RATING_2, WorksRatings::RATING_3, WorksRatings::RATING_4, WorksRatings::RATING_5
            ),
            InvitationsStatuses::TABLE => array(
                InvitationsStatuses::SENT, InvitationsStatuses::ACCEPTED, InvitationsStatuses::PENDING,
            ),
            CodesStatuses::TABLE => array(
                CodesStatuses::RIGHT, CodesStatuses::RIGHT, CodesStatuses::DUPLICATE,
            ),
            ContentLikesSocialNetworks::TABLE => array(
                ContentLikesSocialNetworks::SOCIAL_FB, ContentLikesSocialNetworks::SOCIAL_VK, ContentLikesSocialNetworks::SOCIAL_OK,
            ),
            WinnersByPrize::TABLE => array(
                WinnersByPrize::TIKETS, WinnersByPrize::BOOK, WinnersByPrize::DVD,
            ),
            WorksCommentsStatuses::TABLE => array(
                WorksCommentsStatuses::SENT, WorksCommentsStatuses::ACCEPTED, WorksCommentsStatuses::PENDING,
            ),
            RejectionRequests::TABLE => array(
                RejectionRequests::REJECT_SUBSCRIPTION, RejectionRequests::REJECT_PARTICIPATION,
            ),
        );

        $start = new \DateTime('2013-07-01');
        $end = new \DateTime('2013-07-05');

        foreach ($reports as $table => $dimentions)
            Logic::getDbWriter()->executeQuery("TRUNCATE ".$table);

        foreach ($reports as $table => $dimentions)
            foreach ($dimentions as $dimention)
                foreach(new \DatePeriod($start, new \DateInterval('P1D') ,$end) as $date)
                    Logic::getDbWriter()->executeQuery("INSERT IGNORE INTO ".$table." VALUES ('".$date->format('Y-m-d')."','".$dimention."',".rand(10,100).",'day')");

        foreach ($reports as $table => $dimentions)
            foreach ($dimentions as $dimention)
                foreach(new \DatePeriod($start, new \DateInterval('P1D') ,$end) as $date)
                    if ($date->format('N') == 7)
                        Logic::getDbWriter()->executeQuery("INSERT IGNORE INTO ".$table." VALUES ('".$date->format('Y-m-d')."','".$dimention."',".rand(10,100).",'week')");

        foreach ($reports as $table => $dimentions)
            foreach ($dimentions as $dimention)
                foreach(new \DatePeriod($start, new \DateInterval('P1D') ,$end) as $date)
                    if ($date->format('t') == $date->format('d'))
                        Logic::getDbWriter()->executeQuery("INSERT IGNORE INTO ".$table." VALUES ('".$date->format('Y-m-d')."','".$dimention."',".rand(10,100).",'month')");

    }
}