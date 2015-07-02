<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber
 */

namespace Grabber\Bundle\GrabBundle\Command\Console;


use Grabber\Bundle\GrabBundle\Entity\Source;
use Grabber\Bundle\GrabBundle\Grabber\BaseGrabber;
use Grabber\Bundle\GrabBundle\Grabber\SimpleGrabber;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GrabCommand extends ContainerAwareCommand
{
    /**
     * @param string $name
     *
     * @return null|Source
     */
    private function findSource($name)
    {
        $enManager = $this->getContainer()->get('doctrine.orm.entity_manager');

        return $enManager->getRepository(Source::clazz())->findOneBy(['name' => $name]);
    }

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
                    new InputArgument('sourceName', InputArgument::REQUIRED, 'grabbing source name'),
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
        //set_time_limit(3600);
        $sourceName = $input->getArgument('sourceName');
        $resource = $this->findSource($sourceName);
        /** @var SimpleGrabber $service */
        $service = $this->getContainer()->get($resource->getService());
        $service->setSource($resource);

        $service->grab();

        //$output->writeln("<info>Services have done</info>");
    }
}