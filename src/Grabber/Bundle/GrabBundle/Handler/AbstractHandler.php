<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Handler;

use Grabber\Bundle\GrabBundle\Client\ClientManagerInterface;
use Grabber\Bundle\GrabBundle\Factory\ParseCommandFactory;
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

    function __construct(ClientManagerInterface $clientManager, ParseCommandFactory $commandFactory)
    {
        $this->clientManager  = $clientManager;
        $this->commandFactory = $commandFactory;
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
}