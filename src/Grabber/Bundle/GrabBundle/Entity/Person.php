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
     * @ORM\Column(type="json_array", nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $msisdn;

    /**
     * @ORM\Column(type="string", nullable=true)
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
     * @ORM\ManyToMany(targetEntity="SubCategory")
     * @ORM\JoinTable(name="persons_subcategories",
     *      joinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="subcategory_id", referencedColumnName="id")}
     * )
     */
    private $subcategories;

    /**
     * @ORM\ManyToMany(targetEntity="City")
     * @ORM\JoinTable(name="persons_cities",
     *      joinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="city_id", referencedColumnName="id")}
     * )
     */
    private $cities;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    public function __construct()
    {
        $this->cities        = new ArrayCollection();
        $this->sources       = new ArrayCollection();
        $this->subcategories = new ArrayCollection();
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
     * @return ArrayCollection
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * @param ArrayCollection $sources
     */
    public function setSources($sources)
    {
        $this->sources = $sources;
    }

    /**
     * @return ArrayCollection
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }

    /**
     * @param ArrayCollection $subcategories
     */
    public function setSubcategories($subcategories)
    {
        $this->subcategories = $subcategories;
    }

    /**
     * @return ArrayCollection
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * @param ArrayCollection $cities
     */
    public function setCities($cities)
    {
        $this->cities = $cities;
    }

    /**
     * @return ArrayCollection
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }


    /**
     * @return string
     */
    public static function clazz()
    {
        return get_class();
    }
}