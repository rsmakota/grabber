<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Command\Parse;


interface CommandInterface 
{
    public function parse($client);

    /**
     * @param string $pattern
     */
    public function setPattern($pattern);
}