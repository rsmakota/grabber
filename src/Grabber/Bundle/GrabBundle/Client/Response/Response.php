<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Grabber\Bundle\GrabBundle\Client\Response;


class Response implements ResponseInterface
{
    protected $header  = [];
    protected $content = '';

    /**
     * @param array  $header
     * @param string $content
     */
    public function __construct($header, $content)
    {
        $this->header = $header;
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


}