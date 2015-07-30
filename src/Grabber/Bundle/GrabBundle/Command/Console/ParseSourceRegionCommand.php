<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber
 */

namespace Grabber\Bundle\GrabBundle\Command\Console;


use Grabber\Bundle\GrabBundle\Entity\Source;
use Grabber\Bundle\GrabBundle\Grabber\SimpleGrabber;
use Grabber\Bundle\GrabBundle\Handler\HandlerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ParseSourceRegionCommand extends ContainerAwareCommand
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
            ->setName('parse:source:region')
            ->setDescription('Start parsing region of source')
            ->setDefinition(
                array(
                    new InputArgument('sourceName', InputArgument::REQUIRED, 'parsing source name'),
                )
            )
            ->setHelp(
                <<<EOT
                The <info>parse:source:region</info> start parsing source.
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
        $sourceName = $input->getArgument('sourceName');
        $source     = $this->findSource($sourceName);
        /** @var HandlerInterface $handler */
        $handler = $this->getContainer()->get($source->getConfig()['region']['handler']);
        $handler->setSource($source);

        $handler->process();

        //$output->writeln("<info>Services have done</info>");
    }
}