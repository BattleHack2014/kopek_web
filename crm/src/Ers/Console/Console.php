<?php
namespace Ers\Console;

use Crm\Console\Command\PromoStatus;
use Ers\Console\Command\CrmVersionCommand;

use Ers\Console\Command\CrmStatusCommand;

use Ers\Console\Command\CrmMigrateCommand;

use Ers\Console\Command\CrmGenerateCommand;

use Ers\Console\Command\CrmExecuteCommand;

use Ers\Console\Command\CrmDiffCommand;

use Symfony\Component\Console\Input\InputOption;

use Symfony\Component\Console\Input\InputInterface;

use Symfony\Component\Console\Input\InputArgument;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;
use Ers\Console\Command\EventLogCollect;

/**
 * Класс реализует выполнение служебных задач ERS-системы.
 */
class Console
{
	/**
	 * Запуск команд.
	 * @param HelperSet $helperSet Контейнер ресурсов (конфигурация, коннект к БД и пр)
	 */
	public static function run(InputInterface $input = null, OutputInterface $output = null)
	{
		// Инициализация приложения
		$cli = new Application('ERS Command Line Interface');
		$cli->setAutoExit(false);
		$eventLogCollect = new EventLogCollect();
		$eventLogCollect->addArgument('reader1',InputArgument::REQUIRED);
		$eventLogCollect->addArgument('reader2',InputArgument::OPTIONAL);
		$eventLogCollect->addArgument(
	        'reader3',
	        InputArgument::OPTIONAL
		);

		$eventLogCollect->addOption(
	        'date',
	        null,
	        InputOption::VALUE_REQUIRED,
	        'The start date for AbstractReader',
	        null
		);

		$commands = array(
	        $eventLogCollect,
            new PromoStatus(),
	        //new CrmDiffCommand(), we don't use Doctrine ORM :(
    		new CrmExecuteCommand(),
    		new CrmGenerateCommand(),
    		new CrmMigrateCommand(),
    		new CrmStatusCommand(),
    		new CrmVersionCommand()
		);

		foreach ($commands as $command) {
		    $command->addOption(
    	        'environment',
    	        null,
    	        InputOption::VALUE_REQUIRED,
    	        'Project environment',
    	        null
    		);

		    $command->addOption(
    	        'project',
    	        null,
    	        InputOption::VALUE_REQUIRED,
    	        'Project identifier',
    	        null
    		);
		}

		// Добавление комманд
		$cli->addCommands($commands);
		// Запуск приложения
		$cli->run();
	}
}