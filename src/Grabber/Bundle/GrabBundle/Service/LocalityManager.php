<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Service;


use Doctrine\ORM\EntityManager;
use Grabber\Bundle\GoogleApiBundle\Service\GeoManagerInterface;
use Grabber\Bundle\GrabBundle\Entity\Country;
use Grabber\Bundle\GrabBundle\Entity\Region;
use Grabber\Bundle\GrabBundle\ORM\RegionRepository;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class LocalityManager
 *
 * @package Grabber\Bundle\GrabBundle\Service
 */
class LocalityManager
{
    const LOCALITY_TYPE_CITY    = 'city';
    const LOCALITY_TYPE_REGION  = 'region';
    const LOCALITY_TYPE_COUNTRY = 'country';

    /**
     * @var GeoManagerInterface
     */
    protected $geoManager;
    /**
     * @var EntityManager
     */
    protected $entityManager;

    protected $nameRound = ['name', 'nativeName', 'secondNativeName'];


    /**
     * @param GeoManagerInterface $geoManager
     * @param EntityManager       $entityManager
     */
    public function __construct($geoManager, $entityManager)
    {
        $this->geoManager    = $geoManager;
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $localityParams
     *
     * @return array
     */
    protected function formatLocalityData(array $localityParams)
    {
        $type = $localityParams['type'];
        $data = $localityParams['data'];
        $result = []; $i=0;
        foreach($data as $lang=>$params) {
            $result[$this->nameRound[$i]] = $params[$type];
            $i++;
        }

        return $result;
    }

    /**
     * @param array   $data
     * @param Country $country
     *
     * @return Region
     */
    public function createRegion(array $data, Country $country)
    {
        $bag = new ParameterBag($data);
        $region = new Region();
        $region->setName($bag->get('name'));
        $region->setNativeName($bag->get('nativeName'));
        $region->setSecondNativeName($bag->get('secondNativeName'));
        $region->setCode($bag->get('code'));
        $region->setCountry($country);
        $this->entityManager->persist($region);
        $this->entityManager->flush();

        return $region;
    }

    /**
     * @param string  $name
     * @param Country $country
     * 
     * @return Region|null
     */
    public function findRegion($name, $country)
    {
        /** @var RegionRepository $repository */
        $repository = $this->entityManager->getRepository(Region::clazz());
        $region = $repository->findOneByName($name, $country);
        if (null != $region) {
            return $region;
        }

        $regionData = $this->geoManager->findPlace($name, $country->getLanguages(), $country->getIso2());
        if ($regionData['type'] != self::LOCALITY_TYPE_REGION) {
            return null;
        }

        $formatData = $this->formatLocalityData($regionData);

        return $this->createRegion($formatData, $country);

    }

}