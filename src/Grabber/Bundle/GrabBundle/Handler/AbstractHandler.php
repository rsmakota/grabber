<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Handler;

use Doctrine\ORM\EntityManager;
use Grabber\Bundle\GrabBundle\Client\ClientManagerInterface;
use Grabber\Bundle\GrabBundle\Command\Parse\Response\ResponseInterface;
use Grabber\Bundle\GrabBundle\Entity\Source;
use Grabber\Bundle\GrabBundle\Factory\ParseCommandFactory;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class AbstractHandler
 *
 * @package Grabber\Bundle\GrabBundle\Handler
 */
abstract class AbstractHandler implements HandlerInterface
{
    /**
     * @var ClientManagerInterface
     */
    protected $clientManager;

    /**
     * @var ParseCommandFactory
     */
    protected $commandFactory;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var Source
     */
    protected $source;

    /**
     * @param ClientManagerInterface $clientManager
     * @param ParseCommandFactory    $commandFactory
     */
    function __construct(ClientManagerInterface $clientManager, ParseCommandFactory $commandFactory)
    {
        $this->clientManager  = $clientManager;
        $this->commandFactory = $commandFactory;
    }

    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Source $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @param Logger $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param ParameterBag $params
     */
    abstract public function process();

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @param string $uri
     * @param string $pattern
     *
     * @return ResponseInterface
     * @throws \Exception
     */
    protected function sendCommand($uri, $pattern)
    {
        $method = 'create' . $this->getName() . 'Command';
        if (!method_exists($this->commandFactory, $method)) {
            throw new \Exception('Command factory doesn\'t have method "' . $method . '"');
        }
        $command = $this->commandFactory->$method(
            $uri,
            $pattern,
            $this->clientManager->getClient()
        );

        return $command->parse();
    }
}