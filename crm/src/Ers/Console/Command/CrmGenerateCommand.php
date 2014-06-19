<?php
namespace Ers\Console\Command;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Crm\Logic\Logic;
use Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand;
use Symfony\Component\Console\Helper\HelperSet;


class CrmGenerateCommand extends GenerateCommand {

    public function execute(InputInterface $input, OutputInterface $output) {
        if(!defined('PROJECT')) define('PROJECT', $input->getOption('project'));
        if(!defined('ENV')) define('ENV', $input->getOption('environment'));

        $connection = Logic::getDbWriter();
        $connection->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        $this->getHelperSet()->set(new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($connection), 'db');
        $this->getHelperSet()->set(new \Symfony\Component\Console\Helper\DialogHelper(), 'dialog');

        parent::execute($input, $output);
    }

}