<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Command\Parse\Response;

/**
 * Class Success
 *
 * @package Grabber\Bundle\GrabBundle\Command\Parse\Response
 */
class Success extends AbstractResponse
{
    /**
     * @param array  $data
     */
    public function __construct(array $data)
    {
        $this->data   = $data;
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return true;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        if ($this->isEmpty()) {
            return self::RESPONSE_EMPTY;
        }

        return self::RESPONSE_SUCCESS;
    }
}