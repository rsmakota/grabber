<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Client;


use Grabber\Bundle\GrabBundle\Service\ProxyConfigManager;

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

    public function __construct(ProxyConfigManager $proxyManager)
    {
        $this->client = new Client();
        $this->proxyManager = $proxyManager;
    }

    /**
     * @param boolean $proxied
     *
     * @return Client
     */
    public function getClient($proxied = false)
    {
        if (!$proxied) {
            return $this->client;
        }
        $conf = $this->proxyManager->selectConfig();
        $this->client->setProxy($conf->getIp(), $conf->getPort());
        $this->client->setProxy($conf->getIp(), $conf->getPort());

        return $this->client;
    }
}