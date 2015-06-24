<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GoogleApiBundle\Command\GeoCode\Response;


interface ResponseInterface 
{
    public function getData();
    public function getStatus();
    public function isSuccess();
}