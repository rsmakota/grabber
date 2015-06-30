<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Entity;


use \Doctrine\ORM\Mapping as Orm;
/**
 * Class Region
 *
 * @package Grabber\Bundle\GrabBundle\Entity\Region
 *
 * @ORM\Entity()
 * @ORM\Table(name="regions")
 */
class Region 
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", name="native_name", nullable=true)
     */
    private $nativeName;

    /**
     * @ORM\Column(type="string", name="second_native_name", nullable=true)
     */
    private $secondNativeName;

    /**
     * @ORM\ManyToOne(targetEntity="Grabber\Bundle\GrabBundle\Entity\Country")
     */
    protected $country;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $code;

    /**
     * Google id
     * @ORM\Column(type="string", name="place_id", nullable=true)
     */
    protected $placeId;

    public function getPlaceId()
    {
        return $this->placeId;
    }

    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
    }

    public function getNativeName()
    {
        return $this->nativeName;
    }

    public function setNativeName($nativeName)
    {
        $this->nativeName = $nativeName;
    }

    public function getSecondNativeName()
    {
        return $this->secondNativeName;
    }

    public function setSecondNativeName($secondNativeName)
    {
        $this->secondNativeName = $secondNativeName;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param Country $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public static function clazz()
    {
        return get_class();
    }
}