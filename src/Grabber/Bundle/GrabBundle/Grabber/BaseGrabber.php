<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Grabber;

use Doctrine\ORM\EntityManager;
use Grabber\Bundle\GrabBundle\Entity\Country;
use GuzzleHttp\Client;

/**
 * Class BaseGrabber
 *
 * @package Grabber\Bundle\GrabBundle\Grabber
 */
class BaseGrabber implements GrabberInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;
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
     * @param EntityManager $entityManager
     * @param Client        $client
     */
    public function __construct($entityManager, $client)
    {
        $this->entityManager = $entityManager;
        $this->client        = $client;
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