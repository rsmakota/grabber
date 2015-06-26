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
        ["name" => "Cherkas'ka oblast",        "code" => "UP01"],
        ["name" => "Chernihivs'ka oblast",     "code" => "UP02"],
        ["name" => "Chernivets'ka oblast",     "code" => "UP03"],
        ["name" => "Dnipropetrovsk Oblast",    "code" => "UP04"],
        ["name" => "Donetsk Oblast",           "code" => "UP05"],
        ["name" => "Ivano-Frankivs'ka oblast", "code" => "UP06"],
        ["name" => "Kharkiv  Oblast",          "code" => "UP07"],
        ["name" => "Khersons'ka oblast",       "code" => "UP08"],
        ["name" => "Khmel'nyts'ka oblast",     "code" => "UP09"],
        ["name" => "Kirovohrads'ka oblast",    "code" => "UP10"],
        ["name" => "Crimea",                   "code" => "UP11"],
        ["name" => "Kyivs'ka oblast",          "code" => "UP13"],
        ["name" => "Luhans'ka oblast",         "code" => "UP14"],
        ["name" => "Lviv Oblast",              "code" => "UP15"],
        ["name" => "Mykolaivs'ka oblast",      "code" => "UP16"],
        ["name" => "Odessa Oblast",            "code" => "UP17"],
        ["name" => "Poltavs'ka oblast",        "code" => "UP18"],
        ["name" => "Rivnens'ka oblast",        "code" => "UP19"],
        ["name" => "Sums'ka oblast",           "code" => "UP21"],
        ["name" => "Ternopil's'ka oblast",     "code" => "UP22"],
        ["name" => "Vinnyts'ka oblast",        "code" => "UP23"],
        ["name" => "Volyns'ka oblast",         "code" => "UP24"],
        ["name" => "Zakarpats'ka oblast",      "code" => "UP25"],
        ["name" => "Zaporiz'ka oblast",        "code" => "UP26"],
        ["name" => "Zhytomyrs'ka oblast",      "code" => "UP27"],
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var Country $ukraine */
//        $ukraine = $this->getReference('country:ukraine');
//        foreach ($this->uaAreas as $area) {
//            $region = new Region();
//            $region->setCountry($ukraine);
//            $region->setName($area["name"]);
//            $region->setCode($area["code"]);
//            $manager->persist($region);
//            $this->setReference("region:".$area["code"], $region);
//        }
//
//        $manager->flush();
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