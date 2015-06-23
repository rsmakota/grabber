<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadCityData
 *
 * @package Grabber\Bundle\GrabBundle\DataFixtures\ORM
 */
class LoadCityData extends AbstractFixture implements OrderedFixtureInterface
{

    private $cities = [
        [
            "areaCode" => "UP04", "cities" => [
            "Apostolove",
            "Vasylkivka",
            "Verkhnodniprovsk",
            "Dnipropetrovsk",
            "Kryvyi Rih",
            "Mezhova",
            "Nikopol",
            "Novomoskovsk",
            "Pavlohrad",
            "Petrykivka",
            "Petropavlivka",
            "Pokrovske",
            "Piatykhatky",
            "Synelnykove",
            "Solone",
            "Sofiivka",
            "Tomakivka",
            "Tsarychanka",
            "Shyroke",
            "Yurivka"]
        ]


    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 120;
    }
}