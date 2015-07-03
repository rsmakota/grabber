<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Handler;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Interface HandlerInterface
 *
 * @package Grabber\Bundle\GrabBundle\Handler
 */
interface HandlerInterface
{
    public function setSource($source);
    public function setCategory($category);
    public function setRegion($region);
    /**
     * @param ParameterBag $params
     */
    public function process(ParameterBag $params);

    /**
     * @return string
     */
    public function getName();
}