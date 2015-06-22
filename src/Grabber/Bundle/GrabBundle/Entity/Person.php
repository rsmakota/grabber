<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use \Doctrine\ORM\Mapping as Orm;
/**
 * @ORM\Entity
 * @ORM\Table(name="persons")
 */
class Person {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type=string)
     */
    private $name;

    /**
     * @ORM\Column(type=string)
     */
    private $msisdn;

    /**
     * @ORM\Column(type=string)
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity="Source")
     * @ORM\JoinTable(name="persons_sources",
     *      joinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="source_id", referencedColumnName="id")}
     * )
     */
    private $sources;

    /**
     * @ORM\ManyToMany(targetEntity="Category")
     * @ORM\JoinTable(name="persons_categories",
     *      joinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="City")
     * @ORM\JoinTable(name="persons_cities",
     *      joinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="city_id", referencedColumnName="id")}
     * )
     */
    private $cities;

    public function __construct()
    {
        $this->city     = new ArrayCollection();
        $this->sources  = new ArrayCollection();
        $this->category = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getCities()
    {
        return $this->cities;
    }

    public function setCities($cities)
    {
        $this->cities = $cities;
    }

    /**
     * @return ArrayCollection
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
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
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * @param string $msisdn
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * @param string $sources
     */
    public function setSources($sources)
    {
        $this->sources = $sources;
    }

    public static function clazz()
    {
        return get_class();
    }
}