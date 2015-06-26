<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GoogleApiBundle\Command\GeoCode\Response;

/**
 * Class Success
 *
 * @package Grabber\Bundle\GoogleApiBundle\Command\GeoCode\Response
 */
class Success extends AbstractResponse implements ResponseInterface
{
    /**
     * @var array
     */
    protected $results;

    /**
     * @param $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->results = $data['results'];
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return true;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }
}