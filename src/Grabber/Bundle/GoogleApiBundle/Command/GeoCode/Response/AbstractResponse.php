<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GoogleApiBundle\Command\GeoCode\Response;

/**
 * Class AbstractResponse
 *
 * @package Grabber\Bundle\GoogleApiBundle\Command\GeoCode\Response
 */
abstract class AbstractResponse implements ResponseInterface
{
    protected $data;
    protected $status;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data    = $data;
        $this->status  = $data['status'];
    }

    /**
     * @return boolean
     */
    public function isOk()
    {
        if ($this->status == 'OK') {
            return true;
        }

        return false;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getStatus()
    {
        return $this->status;
    }

    abstract public function isSuccess();

}