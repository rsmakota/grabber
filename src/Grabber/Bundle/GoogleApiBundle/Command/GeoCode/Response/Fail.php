<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */
namespace Grabber\Bundle\GoogleApiBundle\Command\GeoCode\Response;

/**
 * Class Fail
 *
 * @package Grabber\Bundle\GoogleApiBundle\Command\GeoCode\Response
 */
class Fail extends AbstractResponse implements ResponseInterface
{
    protected $message;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->message = $data['error_message'];
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return false;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}