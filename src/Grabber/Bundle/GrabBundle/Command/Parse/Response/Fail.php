<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Command\Parse\Response;


class Fail extends AbstractResponse
{

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return self::RESPONSE_FAIL;
    }
}