<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Client;


use GuzzleHttp\Client;

/**
 * Interface ClientManagerInterface
 *
 * @package Grabber\Bundle\GrabBundle\Client
 */
interface ClientManagerInterface
{
    /**
     * @param boolean $proxied
     *
     * @return Client
     */
    public function getClient($proxied);
}