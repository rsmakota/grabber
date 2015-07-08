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
     * {'en', 'uk', 'ru'}
     * @ORM\Column(type="json_array")
     */
    private $languages;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
    * @ORM\Column(type="string", name="native_name")
    */
    private $nativeName;

    /**
     * @ORM\Column(type="string", name="second_native_name")
     */
    private $secondNativeName;

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
     * Google id
     * @ORM\Column(type="string", name="place_id")
     */
    protected $placeId;
    /**
     * @ORM\Column(type="string")
     */
    protected $areaName;

    /**
     * @ORM\Column(type="string")
     */
    protected $prefix;

    /**
     * @ORM\Column(type="string")
     */
    protected $pattern;



    /**
     * @return mixed
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param mixed $pattern
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @return mixed
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param mixed $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return mixed
     */
    public function getMsisdnLength()
    {
        return $this->msisdnLength;
    }

    /**
     * @param mixed $msisdnLength
     */
    public function setMsisdnLength($msisdnLength)
    {
        $this->msisdnLength = $msisdnLength;
    }

    /**
     * @ORM\Column(type="integer", name="msisdn_length")
     */
    protected $msisdnLength;

    /**
     * @return string
     */
    public function getAreaName()
    {
        return $this->areaName;
    }

    /**
     * @param string $areaName
     */
    public function setAreaName($areaName)
    {
        $this->areaName = $areaName;
    }


    /**
     * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param array $languages
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
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
    public function getIso3()
    {
        return $this->iso3;
    }

    /**
     * @param string $iso3
     */
    public function setIso3($iso3)
    {
        $this->iso3 = $iso3;
    }

    /**
     * @return string
     */
    public function getTz()
    {
        return $this->tz;
    }

    /**
     * @param string $tz
     */
    public function setTz($tz)
    {
        $this->tz = $tz;
    }

    /**
     * @return string
     */
    public function getIso2()
    {
        return $this->iso2;
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
     * @param string $iso2
     */
    public function setIso2($iso2)
    {
        $this->iso2 = $iso2;
    }

    /**
     * @param string $msisdn
     * @return string
     */
    public function formatMsisdn($msisdn)
    {
        $length = strlen($msisdn);
        if ($length < $this->msisdnLength) {
            $prefix = substr($this->prefix, 0, $this->msisdnLength - $length);
            $msisdn = $prefix.$msisdn;
        }

        return $msisdn;
    }

    /**
     * @param $msisdn
     *
     * @return boolean
     */
    public function isValidMsisdn($msisdn)
    {
        return (boolean) preg_match($this->pattern, $msisdn);
    }

    /**
     * @return string
     */
    public static function clazz()
    {
        return get_class();
    }
}
