<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Command\Parse;

/**
 * Class AbstractCommand
 *
 * @package Grabber\Bundle\GrabBundle\Command\Site
 */
abstract class AbstractCommand implements CommandInterface
{
    protected $pattern;

    protected $name;

    abstract public function parse($client);

    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }
}