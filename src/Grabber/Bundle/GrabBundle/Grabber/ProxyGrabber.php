<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Grabber;

use Grabber\Bundle\GrabBundle\Service\ProxyConfigManager;
use GuzzleHttp\Client;
use Monolog\Logger;

class ProxyGrabber implements GrabberInterface
{
    /**
     * @var ProxyConfigManager
     */
    private $configManager;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param ProxyConfigManager $configManager
     * @param Client             $client
     * @param Logger             $logger
     */
    public function __construct(ProxyConfigManager $configManager, Client $client, Logger $logger)
    {
        $this->configManager = $configManager;
        $this->logger        = $logger;
        $this->client        = $client;
    }

    public function grab()
    {

    }
}