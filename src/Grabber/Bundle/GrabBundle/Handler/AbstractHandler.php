<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Handler;

use Grabber\Bundle\GrabBundle\Client\ClientManagerInterface;
use Grabber\Bundle\GrabBundle\Command\Parse\Response\ResponseInterface;
use Grabber\Bundle\GrabBundle\Entity\Category;
use Grabber\Bundle\GrabBundle\Entity\Source;
use Grabber\Bundle\GrabBundle\Factory\ParseCommandFactory;
use Monolog\Logger;
use Proxies\__CG__\Grabber\Bundle\GrabBundle\Entity\Region;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class AbstractHandler
 *
 * @package Grabber\Bundle\GrabBundle\Handler
 */
abstract class AbstractHandler implements HandlerInterface
{
    /**
     * @var HandlerInterface
     */
    protected $handler;

    /**
     * @var ClientManagerInterface
     */
    protected $clientManager;

    /**
     * @var ParseCommandFactory
     */
    protected $commandFactory;
    /**
     * @var Category
     */
    protected $category;
    /**
     * @var Region
     */
    protected $region;
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @param Source $source
     */
    public function setSource($source)
    {
        $this->source = $source;
        if ($this->handler) {
            $this->handler->setSource($source);
        }
    }

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

    /**
     * @param Logger $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
        if ($this->handler) {
            $this->handler->setCategory($category);
        }

    }

    /**
     * @param Region $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
        if ($this->handler) {
            $this->handler->setRegion($region);
        }
    }

    public function setHandler(HandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param ParameterBag $params
     */
    abstract public function process(ParameterBag $params);

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
        $method = 'create'.$this->getName().'Command';
        if (!method_exists($this->commandFactory, $method)) {
            throw new \Exception('Command factory doesn\'t have method "'.$method.'"');
        }
        $command = $this->commandFactory->$method(
            $uri,
            $pattern,
            $this->clientManager->getClient(false)
        );

        return $command->parse();
    }
}