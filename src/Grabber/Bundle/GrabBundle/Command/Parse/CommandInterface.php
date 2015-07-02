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
     * @return mixed
     */
    public function parse();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $pattern
     */
    public function setPattern($pattern);
}