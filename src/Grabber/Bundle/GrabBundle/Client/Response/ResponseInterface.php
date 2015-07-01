<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Grabber\Bundle\GrabBundle\Client\Response;


interface ResponseInterface 
{
    public function getHeader();
    public function getContent();
}