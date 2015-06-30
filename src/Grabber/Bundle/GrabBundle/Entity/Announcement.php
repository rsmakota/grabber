<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */
namespace Grabber\Bundle\GrabBundle\Entity;
use \Doctrine\ORM\Mapping as Orm;

/**
 * Class Category
 *
 * @package Grabber\Bundle\GrabBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="announcements")
 */
class Announcement
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Grabber\Bundle\GrabBundle\Entity\Source")
     */
    private $source;

    /**
     * @ORM\ManyToMany(targetEntity="Person")
     * @ORM\JoinTable(name="persons_announcements",
     *      joinColumns={@ORM\JoinColumn(name="announcement_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")}
     * )
     */
    private $persons;

    /**
     * ID on the resource
     * @ORM\Column(type = "string")
     */
    private $index;

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
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * @param mixed $persons
     */
    public function setPersons($persons)
    {
        $this->persons = $persons;
    }

    /**
     * @return mixed
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param mixed $index
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }

    /**
     * @return string
     */
    public static function clazz()
    {
        return get_class();
    }
}