<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Grabber;

use Doctrine\ORM\EntityManager;
use Grabber\Bundle\GrabBundle\Entity\Country;
use Grabber\Bundle\GrabBundle\Service\LocalityManager;
use GuzzleHttp\Client;

/**
 * Class BaseGrabber
 *
 * @package Grabber\Bundle\GrabBundle\Grabber
 */
class BaseGrabber implements GrabberInterface
{
    /**
     * @var string
     */
    protected $baseUri;
    /**
     * @var Country
     */
    protected $country;

    /**
     * @var Client
     */
    protected $client;
    /**
     * @var LocalityManager
     */
    protected $localityManager;

    /**
     * @param LocalityManager $localityManager
     * @param Client          $client
     */
    public function __construct($localityManager, $client)
    {
        $this->client          = $client;
        $this->localityManager = $localityManager;
    }

    /**
     * @param Country $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @param string $baseUri
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
    }


    public function grab()
    {
        // TODO: Implement grab() method.
    }
}