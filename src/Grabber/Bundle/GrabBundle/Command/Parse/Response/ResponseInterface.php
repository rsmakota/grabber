<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Command\Parse\Response;

/**
 * Interface ResponseInterface
 *
 * @package Grabber\Bundle\GrabBundle\Command\Parse\Response
 */
interface ResponseInterface
{
    public function getData();
    public function getStatus();
    public function isSuccess();
    public function isEmpty();
}