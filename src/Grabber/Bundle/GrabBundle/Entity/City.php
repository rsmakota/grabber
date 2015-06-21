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
 * @package Nebupay\Bundle\PaymentFormBundle\Entity\Split
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
     * @ORM\ManyToOne(targetEntity="Grabber\Bundle\GrabBundle\Entity\Country")
     */
    protected $country;


    /**
     * @ORM\Column(type="string")
     */
    protected $name;


    /**
     * @return string
     */
    public static function clazz()
    {
        return get_class();
    }
} 