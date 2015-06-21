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
     * @return Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param Logger $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param ProxyConfigManager $configManager
     * @param Client             $client
     */
    public function __construct(ProxyConfigManager $configManager, Client $client)
    {
        $this->configManager = $configManager;
        $this->client        = $client;
    }

    public function grab()
    {
        $response = $this->client->get('');
        var_dump($response->getBody()->getContents());
    }
}