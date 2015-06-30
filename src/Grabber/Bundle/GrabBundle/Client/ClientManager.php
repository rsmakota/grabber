<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Client;


use Grabber\Bundle\GrabBundle\Service\ProxyConfigManager;
use GuzzleHttp\Client;

/**
 * Class ClientManager
 *
 * @package Grabber\Bundle\GrabBundle\Client
 */
class ClientManager implements ClientManagerInterface
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var ProxyConfigManager
     */
    private $proxyManager;

    public function __construct(Client $client, ProxyConfigManager $proxyManager)
    {
        $this->client = $client;
        $this->proxyManager = $proxyManager;
    }


    /**
     * @param boolean $proxied
     *
     * @return Client
     */
    public function getClient($proxied = true)
    {
        // TODO: Implement getClient() method.
    }
}