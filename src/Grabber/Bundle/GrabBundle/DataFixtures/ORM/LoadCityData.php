<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Grabber\Bundle\GrabBundle\Entity\City;

/**
 * Class LoadCityData
 *
 * @package Grabber\Bundle\GrabBundle\DataFixtures\ORM
 */
class LoadCityData extends AbstractFixture implements OrderedFixtureInterface
{

    private $cities = [
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
            "Yurivka"
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $dnepr = $this->getReference("region:UP04");
        foreach ($this->cities as $cityName) {
            $city = new City();
            $city->setName($cityName);
            $manager->persist($city);
        }

        $manager->flush();
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