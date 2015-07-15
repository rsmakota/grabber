<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Handler;

use Grabber\Bundle\GrabBundle\Entity\City;
use Grabber\Bundle\GrabBundle\Service\AnnounceManager;
use Grabber\Bundle\GrabBundle\Service\LocalityManager;
use Grabber\Bundle\GrabBundle\Service\PersonManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class AnnounceHandler
 *
 * @package Grabber\Bundle\GrabBundle\Handler
 */
class AnnounceHandler extends AbstractHandler
{

    /**
     * @var LocalityManager
     */
    protected $localityManager;

    /**
     * @var PersonManager
     */
    protected  $personManager;

    /**
     * @var AnnounceManager
     */
    protected $announceManager;

    /**
     * @param PersonManager $personManager
     */
    public function setPersonManager($personManager)
    {
        $this->personManager = $personManager;
    }

    /**
     * @param AnnounceManager $announceManager
     */
    public function setAnnounceManager($announceManager)
    {
        $this->announceManager = $announceManager;
    }

    /**
     * @param LocalityManager $localityManager
     */
    public function setLocalityManager($localityManager)
    {
        $this->localityManager = $localityManager;
    }

    /**
     * @param array $data
     */
    protected function updatePerson($data)
    {
        $person = $this->personManager->findByMsisdn($data['msisdn']);
        if (!$person) {
            $this->personManager->create($data);
            return;
        }
        $person->addName($data['name']);
        $person->addCity($data['city']);
        $person->addAnnounce($data['announce']);
        $person->addCategory($data['category']);
        $this->personManager->update($person);
    }

    /**
     * @param array        $data
     * @param ParameterBag $params
     */
    protected function createEntities(array $data, ParameterBag $params)
    {
        /** @var City $city */
        $city = $this->localityManager->findCity($data['city'], $this->region);
        $country = $this->region->getCountry();
        if ($this->announceManager->hasIndex($data['announceId'])) {
            return;
        }

        $announce = $this->announceManager->create( [
            'uri'      => $params->get('uri'),
            'index'    => $data['announceId'],
            'source'   => $this->source,
            'created'  => \DateTime::createFromFormat($params->get('createdFormat'), $data['created']),
            'category' => $this->category,
        ]);
        foreach ($data['msisdn'] as $msisdn) {
            $msisdn = $country->formatMsisdn($msisdn);
            dump($msisdn);
            if (!$country->isValidMsisdn($msisdn)) {
                continue;
            }
            $this->updatePerson([
                'name'     => $data['personName'],
                'msisdn'   => $msisdn,
                'city'     => $city,
                'announce' => $announce,
                'category' => $this->category

            ]);
        }
    }

    /**
     * @param ParameterBag $params
     */
    public function process(ParameterBag $params)
    {
        $this->logger->addDebug('Init ' . $this->getName() . ' parse uri ' . $params->get('uri'));
        $response = $this->sendCommand($params->get('uri'), $params->get('pattern'));
        dump($params->get('uri'));
        $this->logger->addDebug('Result ', $response->getData());
        if (!$response->isEmpty()) {
            $this->createEntities($response->getData(), $params);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Announce';
    }
}