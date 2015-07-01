<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Command\Parse;


use Grabber\Bundle\GrabBundle\Client\ClientInterface;

interface CommandInterface
{
    /**
     * @param string          $uri
     * @param ClientInterface $client
     *
     * @return mixed
     */
    public function parse($uri, ClientInterface $client);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $pattern
     */
    public function setPattern($pattern);
}