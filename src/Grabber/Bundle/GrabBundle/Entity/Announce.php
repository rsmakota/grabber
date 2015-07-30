<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Grabber\Bundle\GrabBundle\Entity;

use \Doctrine\ORM\Mapping as Orm;

/**
 * @ORM\Entity
 * @ORM\Table(name="announce")
 */
class Announce
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $uri;

    /**
     * @ORM\ManyToOne(targetEntity="Grabber\Bundle\GrabBundle\Entity\SourceRegion")
     */
    private $sourceRegion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $processed;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    public function getSourceRegion()
    {
        return $this->sourceRegion;
    }

    public function setSourceRegion($sourceRegion)
    {
        $this->sourceRegion = $sourceRegion;
    }

    public function getProcessed()
    {
        return $this->processed;
    }

    public function setProcessed($processed)
    {
        $this->processed = $processed;
    }

}