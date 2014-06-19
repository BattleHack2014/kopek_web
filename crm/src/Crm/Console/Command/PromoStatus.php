<?php
namespace Crm\Console\Command;

use Crm\Model\Campaign\CampaignCollection;
use Symfony\Component\Console\Input\InputInterface,
	Symfony\Component\Console\Output\OutputInterface,
	Symfony\Component\Console\Command\Command,
    Crm\Logic\Logic;

class PromoStatus extends Command {

	/**
	 * (non-PHPdoc)
	 * @see Symfony\Component\Console\Command.Command::configure()
	 */
	protected function configure() {
		$this->setName('promoStatus');
		$this->setDescription('Activate and Deactivate promo campaigns');
	}

	/**
	 * (non-PHPdoc)
	 * @see Symfony\Component\Console\Command.Command::execute()
	 */
	protected function execute(InputInterface $input, OutputInterface $output) {
        if(!defined('ENV')) define('ENV', $input->getOption('environment'));
        $campaign_collection = new CampaignCollection();

        if ($campaign_collection->activate())
            echo 'Кеш очищен' . PHP_EOL;

        if ($campaign_collection->deactive())
            echo 'Кеш очищен' . PHP_EOL;
	}
}