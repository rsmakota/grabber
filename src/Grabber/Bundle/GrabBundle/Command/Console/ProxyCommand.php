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
        $proxy = $this->getContainer()->get('grabber_proxy_grabber');
        $proxy->grab();

        $output->writeln("<info>Services have done</info>");
    }
}