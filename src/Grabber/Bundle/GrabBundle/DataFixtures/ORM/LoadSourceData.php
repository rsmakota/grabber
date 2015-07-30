<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Grabber\Bundle\GrabBundle\Entity\Source;

class LoadSourceData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $country = $this->getReference('country:ukraine');
        $source = new Source();
        $source->setName('besplatka');
        $source->setUrl('http://besplatka.ua');
        $source->setCountry($country);
        $source->setService('grabber_simple_grabber');
        $source->setConfig(
            [
                'region' => [
                    'pattern' => '|<a id="region_[0-9]+" href="([^"]+)" title="[^"]+" rel="nofollow">([^<]+)<\/a>|',
                    'handler' => 'grabber_region_handler'
                ],
                'category' => [
                    'pattern' => '|<h3>[\s]*<a href="http:\/\/besplatka.ua\/([^"^\/]+)">([^!]+)<\/a>|',
                    'handler' => 'grabber_category_handler'
                ],
                'page' => [
                    'pattern' => '|<a data-npage="([0-9]+)"[^>]*>|',
                ],
                'announceList' => [
                    'pattern' => '|<div class="one_message_title">[\s]*<a href="((?:(?!spec).)*)"><h3>|',
                ],
                'announce' => [
                    'msisdn'        => '|<div class="phone3">([0-9\s]*)</div>|',
                    'city'          => '|<div class="city">[\s]*Город:[\s]*<div class="text">([^<]+)</div>|',
                    'created'       => '|<div class="date_start">Добавлено: ([^<]+)</div>|',
                    'announceId'    => '|<div class="id_advert">ID объявления: ([^<]+)</div>|',
                    'personName'    => '|<div class="name">([^<]+)</div>|',
                    'createdFormat' => 'd.m.Y'
                ]
            ]
        );
        $manager->persist($source);
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