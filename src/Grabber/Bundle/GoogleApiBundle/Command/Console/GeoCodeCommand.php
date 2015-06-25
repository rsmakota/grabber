<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Grabber\Bundle\GoogleApiBundle\Command\Console;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GeoCodeCommand extends ContainerAwareCommand
{
    /**
     * @return \Grabber\Bundle\GoogleApiBundle\Service\GeoCodeManager
     */
    private function getManager()
    {
        return $this->getContainer()->get('google_api_manager');
    }

    /**
     * @see Console\Command\Command
     */
    protected function configure()
    {
        $this
            ->setName('google:command:geocode')
            ->setDescription('Makes geocode request to google api')
            ->setDefinition(
                array(
                    new InputArgument('address', InputArgument::REQUIRED, 'main parameter address'),
                )
            )
            ->setHelp(
                <<<EOT
                The <info>google:command:geocode</info> Makes geocode request to google api.
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
        //set_time_limit(3600);
        $address = $input->getArgument('address');
        $result = $this->getManager()->findPlace($address, ['ru', 'uk', 'en'], 'UA');
        var_dump($result);

    }
}