<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */
namespace Grabber\Bundle\GrabBundle\Entity;
use \Doctrine\ORM\Mapping as Orm;

/**
 * Class City
 *
 * @package Grabber\Bundle\GrabBundle\Entity\City
 *
 * @ORM\Entity
 * @ORM\Table(name="cities")
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string")
     */
    protected $name;


    /**
     * @ORM\ManyToOne(targetEntity="Grabber\Bundle\GrabBundle\Entity\Region")
     */
    protected $region;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public static function clazz()
    {
        return get_class();
    }
} 