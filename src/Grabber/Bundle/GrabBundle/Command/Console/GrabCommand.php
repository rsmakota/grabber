<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber
 */

namespace Grabber\Bundle\GrabBundle\Command\Console;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GrabCommand extends ContainerAwareCommand
{
    /**
     * @see Console\Command\Command
     */
    protected function configure()
    {
        $this
            ->setName('grabber:command:grab')
            ->setDescription('Start site grabbing')
            ->setDefinition(
                array(
                    new InputArgument('serviceId', InputArgument::REQUIRED, 'grabbing service ID'),
                )
            )
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
        set_time_limit(3600);
        $serviceId = $input->getArgument('serviceId');


        $output->writeln("<info>Services have done</info>");
    }
}