<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Service;


use Doctrine\ORM\EntityManager;
use Grabber\Bundle\GoogleApiBundle\Service\GeoManagerInterface;
use Grabber\Bundle\GrabBundle\Entity\City;
use Grabber\Bundle\GrabBundle\Entity\CityName;
use Grabber\Bundle\GrabBundle\Entity\Country;
use Grabber\Bundle\GrabBundle\Entity\Region;
use Grabber\Bundle\GrabBundle\Entity\RegionName;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class LocalityManager
 *
 * @package Grabber\Bundle\GrabBundle\Service
 */
class LocalityManager extends BaseManager
{
    const LOCALITY_TYPE_CITY    = 'city';
    const LOCALITY_TYPE_REGION  = 'region';
    const LOCALITY_TYPE_COUNTRY = 'country';

    /**
     * @var GeoManagerInterface
     */
    protected $geoManager;

    /**
     * Fill Queue from locality
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
     * @param string $name
     * @param City   $city
     *
     * @return RegionName
     */
    public function createCityName($name, City $city)
    {
        $cityName = new CityName();
        $cityName->setName($name);
        $cityName->setCity($city);
        $cityName->setRegion($city->getRegion());

        $this->entityManager->persist($cityName);
        $this->entityManager->flush();

        return $cityName;
    }

    /**
     * @param array  $data
     * @param Region $region
     *
     * @return City
     */
    public function createCity(array $data, Region $region)
    {
        $bag = new ParameterBag($data);
        $city = new City();
        $city->setName($bag->get('name'));
        $city->setNativeName($bag->get('nativeName'));
        $city->setSecondNativeName($bag->get('secondNativeName'));
        $city->setPlaceId($bag->get('placeId'));
        $city->setRegion($region);


        $this->entityManager->persist($city);
        $this->entityManager->flush();

        return $city;
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

    /**
     * @param string $name
     * @param Region $region
     * @return City
     */
    public function findCity($name, Region $region)
    {
        /** @var CityName $cityName */
        $cityName = $this->entityManager->getRepository(CityName::clazz())->findOneBy(['name' => $name, 'region' =>$region]);
        if (null != $cityName) {
            return $cityName->getCity();
        }
        // getting google data by city name
        $cityData = $this->geoManager->findPlace(
            $name,
            $region->getCountry()->getLanguages(),
            $region->getCountry()->getIso2(),
            ['administrative_area_level_1' => $region->getName()]
        );
        // Is the result a region
        if ($cityData['type'] != self::LOCALITY_TYPE_CITY) {
            // if google doesn't know this city we create own city and continue work
            $city = $this->createCity(['nativeName' => $name, 'name' => 'UNKNOWN'], $region);
            $this->createCityName($name, $city);
            return $city;
        }
        // Trying find city by place_id
        $city = $this->entityManager->getRepository(City::clazz())->findOneBy(['placeId' => $cityData['place_id']]);
        if (null != $city) {
            $this->createCityName($name, $city);
            return $city;
        }

        $formatData = $this->formatLocalityData($cityData);
        // It's new region and we are creating Region and RegionName
        $city = $this->createCity($formatData, $region);
        $this->createCityName($name, $city);

        return $city;
    }

}