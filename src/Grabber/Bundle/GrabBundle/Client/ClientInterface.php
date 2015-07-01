<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Client;


use Grabber\Bundle\GrabBundle\Client\Response\ResponseInterface;

/**
 * Interface ClientInterface
 *
 * @package Grabber\Bundle\GrabBundle\Client
 */
interface ClientInterface
{
    /**
     * @param string $uri
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function get($uri, $options=[]);

    /**
     * @param string $uri
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function post($uri, $options=[]);

    /**
     * @param string $ip
     * @param string $port
     */
    public function setProxy($ip, $port);
}