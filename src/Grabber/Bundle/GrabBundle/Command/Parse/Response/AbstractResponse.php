<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Command\Parse\Response;

/**
 * Class AbstractResponse
 *
 * @package Grabber\Bundle\GrabBundle\Command\Parse\Response
 */
abstract class AbstractResponse implements ResponseInterface
{

    const RESPONSE_SUCCESS = 'success';
    const RESPONSE_FAIL    = 'fail';
    const RESPONSE_EMPTY   = 'empty';

    protected $data = [];

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
    abstract public function getStatus();

    /**
     * @return boolean
     */
    abstract public function isSuccess();

    /**
     * @return boolean
     */
    public function isEmpty()
    {
        return empty($this->data);
    }
}