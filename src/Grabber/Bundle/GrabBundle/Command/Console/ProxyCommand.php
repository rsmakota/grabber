<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber
 */

namespace Grabber\Bundle\GrabBundle\Command\Console;


use Grabber\Bundle\GrabBundle\Client\Client;
use Grabber\Bundle\GrabBundle\Command\Parse\AnnounceCommand;
use Grabber\Bundle\GrabBundle\Command\Parse\AnnounceListCommand;
use Grabber\Bundle\GrabBundle\Command\Parse\CategoryCommand;
use Grabber\Bundle\GrabBundle\Command\Parse\PageCommand;
use Grabber\Bundle\GrabBundle\Command\Parse\RegionCommand;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProxyCommand extends ContainerAwareCommand
{
    /**
     * @see Console\Command\Command
     */
    protected function configure()
    {
        $this
            ->setName('grabber:proxy:grab')
            ->setDescription('Start proxy grabbing')
            ->setHelp(
                <<<EOT
                The <info>grabber:command:grab</info> start grabbing site.
EOT
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @see Console\Command\Command
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $proxy = $this->getContainer()->get('grabber_proxy_grabber');
//        $proxy->grab();
//
//        $output->writeln("<info>Services have done</info>");
        $client = new Client();
        //$client->setProxy('37.187.178.159', 3128);
        //$command = new RegionCommand();
        //$command->setPattern('|<a id="region_[0-9]+" href="([^"]+)" title="[^"]+" rel="nofollow">([^<]+)<\/a>|');
//        $command = new CategoryCommand();
//        $command->setPattern('|<a href="([^"]+)">([^<]+)</a>[\s]*<span>[0-9]+</span>|');
//        protected $msisdnPattern = '|<div class="phone3">([0-9]*)&nbsp;</div>[\s]*<div class="mpphone">([0-9\s]*)</div>|';
//
//        protected $cityPattern = '|<div class="city">[\s]*Город:[\s]*<div class="text">([^<]+)</div>|';
//
//        protected $createdPattern = '|<div class="date_start">Добавлено: ([^<]+)</div>|';
//
//        protected $announceIdPattern = '|<div class="id_advert">ID объявления: ([^<]+)</div>|';
//
//        protected $personNamePattern = '|<div class="name">([^<]+)</div>|';

        $command = new AnnounceCommand();
        $command->setMsisdnPattern('|<div class="phone3">([0-9]*)&nbsp;</div>[\s]*<div class="mpphone">([0-9\s]*)</div>|');
        $command->setCityPattern('|<div class="city">[\s]*Город:[\s]*<div class="text">([^<]+)</div>|');
        $command->setCreatedPattern('|<div class="date_start">Добавлено: ([^<]+)</div>|');
        $command->setAnnounceIdPattern('|<div class="id_advert">ID объявления: ([^<]+)</div>|');
        $command->setPersonNamePattern('|<div class="name">([^<]+)</div>|');

        $response = $command->parse('http://dneprodzerzhinsk.dp.besplatka.ua/obyavlenie/spining-bez-katushki-7762460', $client);

        var_dump($response);
    }
}