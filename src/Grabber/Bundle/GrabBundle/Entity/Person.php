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
    private $name=[];

    /**
     * @ORM\Column(type="string")
     */
    private $msisdn;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity="Announce")
     * @ORM\JoinTable(name="persons_announces",
     *      joinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="announce_id", referencedColumnName="id")}
     * )
     */
    private $announces;

    /**
     * @ORM\ManyToMany(targetEntity="Category")
     * @ORM\JoinTable(name="persons_categories",
     *      joinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     */
    private $categories;

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
        $this->cities     = new ArrayCollection();
        $this->announces  = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function addCity(City $city)
    {
        if ($this->cities->contains($city)) {
            return;
        }

        $this->cities->add($city);
    }

    public function addAnnounce(Announce $announce)
    {
        $this->announces->add($announce);
    }

    public function addCategory(Category $category)
    {
        if ($this->categories->contains($category)) {
            return;
        }
        $this->categories->add($category);
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
     * @return array
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $name
     */
    public function addName($name)
    {
        if (!empty($name) && !in_array($name, $this->name)) {
           $this->name[] = $name;
        }
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
    public function getAnnounces()
    {
        return $this->announces;
    }

    /**
     * @param  ArrayCollection $announces
     */
    public function setAnnounces($announces)
    {
        $this->announces = $announces;
    }

    /**
     * @return ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
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