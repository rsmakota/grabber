<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Handler;

/**
 * Interface HandlerInterface
 *
 * @package Grabber\Bundle\GrabBundle\Handler
 */
interface HandlerInterface
{
    public function setSource($source);

    public function process();

    /**
     * @return string
     */
    public function getName();
}