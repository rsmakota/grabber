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
use Grabber\Bundle\GrabBundle\Entity\RegionName;
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
    /**
     * @var array
     */
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
        $result = ['placeId' => $localityParams['place_id']]; $i=0;
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
        $region->setPlaceId($bag->get('placeId'));
        $region->setCountry($country);
        $this->entityManager->persist($region);
        $this->entityManager->flush();

        return $region;
    }

    /**
     * @param string $name
     * @param Region $region
     *
     * @return RegionName
     */
    public function createRegionName($name, Region $region)
    {
        $regionName = new RegionName();
        $regionName->setName($name);
        $regionName->setRegion($region);
        $regionName->setCountry($region->getCountry());

        $this->entityManager->persist($regionName);
        $this->entityManager->flush();

        return $regionName;
    }

    /**
     * @param string  $name
     * @param Country $country
     * 
     * @return Region|null
     */
    public function findRegion($name, $country)
    {
        /** @var RegionName $regionName */
        $regionName = $this->entityManager->getRepository(RegionName::clazz())->findOneBy(['name' => $name, 'country' =>$country]);
        if (null != $regionName) {
            return $regionName->getRegion();
        }
        // getting google data by region name
        $regionData = $this->geoManager->findPlace($name, $country->getLanguages(), $country->getIso2());
        // Is the result a region
        if ($regionData['type'] != self::LOCALITY_TYPE_REGION) {
            // if google doesn't know this region we create own region and continue work
            $region = $this->createRegion(['nativeName' => $name], $country);
            $this->createRegionName($name, $region);
            return $region;
        }
        // Trying find region by place_id
        $region = $this->entityManager->getRepository(Region::clazz())->findOneBy(['placeId' => $regionData['place_id']]);
        if (null != $region) {
            $this->createRegionName($name, $region);
            return $region;
        }

        $formatData = $this->formatLocalityData($regionData);
        // It's new region and we are creating Region and RegionName
        $region = $this->createRegion($formatData, $country);
        $this->createRegionName($name, $region);

        return $region;
    }

}