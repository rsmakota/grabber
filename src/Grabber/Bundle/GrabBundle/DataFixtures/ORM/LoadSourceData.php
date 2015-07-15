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
        $source->setName('Besplatka');
        $source->setUrl('http://besplatka.ua');
        $source->setCountry($country);
        $source->setService('grabber_simple_grabber');
        $source->setConfig([
            'handle' => [
                'name' => 'Region',
                'pattern' => '|<a id="region_[0-9]+" href="([^"]+)" title="[^"]+" rel="nofollow">([^<]+)<\/a>|',
                'handle' => [
                    'name' => 'Category',
                    'pattern' => '|<a href="([^"]+)">([^<]+)</a>[\s]*<span>[0-9]+</span>|',
                    'handle' => [
                        'name' => 'Page',
                        'pattern' => '|<a data-npage="([0-9]+)"[^>]*>|',
                        'handle' => [
                            'name' => 'AnnounceList',
                            'pattern' => '|<div class="one_message_title">[\s]*<a href="((?:(?!spec).)*)"><h3>|',
                            'handle' => [
                                'name' => 'Announce',
                                'pattern' => [
                                    'msisdn'     => '|<div class="phone3">([0-9\s]*)</div>|',
                                    'city'       => '|<div class="city">[\s]*Город:[\s]*<div class="text">([^<]+)</div>|',
                                    'created'    => '|<div class="date_start">Добавлено: ([^<]+)</div>|',
                                    'announceId' => '|<div class="id_advert">ID объявления: ([^<]+)</div>|',
                                    'personName' => '|<div class="name">([^<]+)</div>|'
                                ],
                                'createdFormat' => 'd.m.Y'
                            ]
                        ]
                    ]
                ]
            ]
        ]);
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