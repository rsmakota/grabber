<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Grabber\Bundle\GrabBundle\Entity\Country;
use Grabber\Bundle\GrabBundle\Entity\Region;

/**
 * Class LoadRegionData
 *
 * @package Grabber\Bundle\GrabBundle\DataFixtures\ORM
 */
class LoadRegionData extends AbstractFixture implements OrderedFixtureInterface
{
    private $uaAreas = [
        ["name" => "Cherkasy",        "code" => "UP01"],
        ["name" => "Chernihiv",       "code" => "UP02"],
        ["name" => "Chernivetsi",     "code" => "UP03"],
        ["name" => "Dnipropetrovk",   "code" => "UP04"],
        ["name" => "Donetsk",         "code" => "UP05"],
        ["name" => "Ivano-Frankivsk", "code" => "UP06"],
        ["name" => "Kharkiv",         "code" => "UP07"],
        ["name" => "Kherson",         "code" => "UP08"],
        ["name" => "Khmelnytskyi",    "code" => "UP09"],
        ["name" => "Kirovohrad",      "code" => "UP10"],
        ["name" => "Crimea",          "code" => "UP11"],
        ["name" => "Kyïv",            "code" => "UP13"],
        ["name" => "Luhansk",         "code" => "UP14"],
        ["name" => "Lviv",            "code" => "UP15"],
        ["name" => "Mykolaiv",        "code" => "UP16"],
        ["name" => "Odessa",          "code" => "UP17"],
        ["name" => "Poltava",         "code" => "UP18"],
        ["name" => "Rivne",           "code" => "UP19"],
        ["name" => "Sumy",            "code" => "UP21"],
        ["name" => "Ternopil",        "code" => "UP22"],
        ["name" => "Vinnytsia",       "code" => "UP23"],
        ["name" => "Volyn",           "code" => "UP24"],
        ["name" => "Zakarpattia",     "code" => "UP25"],
        ["name" => "Zaporizhia",      "code" => "UP26"],
        ["name" => "Zhytomyr",        "code" => "UP27"],
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var Country $ukraine */
        $ukraine = $this->getReference('country:ukraine');
        foreach ($this->uaAreas as $area) {
            $region = new Region();
            $region->setCountry($ukraine);
            $region->setName($area["name"]);
            $region->setCode($area["code"]);
            $manager->persist($region);
            $this->setReference("region:".$area["code"], $region);
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
        return 110;
    }
}