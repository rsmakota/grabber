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

/**
 * Class LoadCountryData
 * 
 * @package Grabber\Bundle\GrabBundle\DataFixtures\ORM
 */
class LoadCountryData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $country = new Country();
        $country->setName('Ukraine');
        $country->setLanguages(['en', 'uk', 'ru']);
        $country->setIso2('UA');
        $country->setIso3('UKR');
        $country->setTz('Europe/Kiev');
        $country->setNativeName('Україна');
        $country->setSecondNativeName('Украина');
        $country->setPlaceId('ChIJjw5wVMHZ0UAREED2iIQGAQA');
        $country->setAreaName('область');
        $country->setMsisdnLength(12);
        $country->setPattern('|^380[\d]{9}$|');
        $country->setPrefix('380');
        $manager->persist($country);
        $this->setReference('country:ukraine', $country);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 100;
    }
}