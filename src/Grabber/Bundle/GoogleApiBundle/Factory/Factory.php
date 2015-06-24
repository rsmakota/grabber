<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Grabber\Bundle\GoogleApiBundle\Factory;


use Grabber\Bundle\GoogleApiBundle\Command\GeoCode\AddressCommand;

class Factory
{
    private $client;
    private $uri;

    public function __construct($client, $uri)
    {
        $this->client = $client;
        $this->uri = $uri;
    }

    /**
     * @param array $params
     *
     * @return AddressCommand
     */
    public function createAddressCommand(array $params)
    {
        $params['uri'] = $this->uri;
        return new AddressCommand($this->client, $params);
    }
}