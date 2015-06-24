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
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", name="native_name")
     */
    private $nativeName;

    /**
     * @ORM\Column(type="string", name="second_native_name")
     */
    private $secondNativeName;

    /**
     * @ORM\ManyToOne(targetEntity="Grabber\Bundle\GrabBundle\Entity\Region")
     */
    private $region;

    /**
     * Google id
     * @ORM\Column(type="string", name="place_id")
     */
    protected $placeId;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getPlaceId()
    {
        return $this->placeId;
    }

    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
    }

    /**
     * @return string
     */
    public function getNativeName()
    {
        return $this->nativeName;
    }

    /**
     * @param string $nativeName
     */
    public function setNativeName($nativeName)
    {
        $this->nativeName = $nativeName;
    }

    /**
     * @return string
     */
    public function getSecondNativeName()
    {
        return $this->secondNativeName;
    }

    /**
     * @param string $secondNativeName
     */
    public function setSecondNativeName($secondNativeName)
    {
        $this->secondNativeName = $secondNativeName;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string
     */
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

    /**
     * @param Region $region
     */
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