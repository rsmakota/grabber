<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */
namespace Grabber\Bundle\GrabBundle\Entity;
use \Doctrine\ORM\Mapping as Orm;
/**
 * @ORM\Entity
 * @ORM\Table(name="countries")
 */
class Country
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=3, options={"fixed" = true})
     */
    protected $iso3;

    /**
     * @ORM\Column
     */
    protected $tz;

    /**
     * @ORM\Column(type="string", length=2, options={"fixed" = true})
     */
    protected $iso2;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIso3()
    {
        return $this->iso3;
    }

    /**
     * @param mixed $iso3
     */
    public function setIso3($iso3)
    {
        $this->iso3 = $iso3;
    }

    /**
     * @return mixed
     */
    public function getTz()
    {
        return $this->tz;
    }

    /**
     * @param mixed $tz
     */
    public function setTz($tz)
    {
        $this->tz = $tz;
    }

    /**
     * @return mixed
     */
    public function getIso2()
    {
        return $this->iso2;
    }

    /**
     * @param mixed $iso2
     */
    public function setIso2($iso2)
    {
        $this->iso2 = $iso2;
    }

    public static function clazz()
    {
        return get_class();
    }
}
