<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Grabber\Bundle\GoogleApiBundle\Service;


use Grabber\Bundle\GoogleApiBundle\Factory\Factory;

class GeoCodeManager
{
    /**
     * @var Factory
     */
    private $factory;

    private $resultTypes = ['locality' => 'city', 'administrative_area_level_1' => 'area', 'country' => 'country'];

    /**
     * @param array $data
     *
     * @return array
     */
    private function formatCityResponse(array $data)
    {
        foreach ($data[0]['address_components'] as $components) {
            $type = $components['types'][0];
            if (array_key_exists($type, $this->resultTypes )) {
                $result[$this->resultTypes[$type]] = $components['long_name'];
            }
        }

        return $result;
    }

    public function __construct($factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    private function getTypeResult($data)
    {
        return $this->resultTypes[$data[0]['types'][0]];
    }

    /**
     * @param array $data
     *
     * @return string
     */
    private function getPlaceId(array $data)
    {
        return $data[0]['place_id'];
    }

    /**
     * @param string $name
     * @param array  $languages
     * @param string $country
     * @param array  $options
     *
     * @return array
     */
    public function findPlace($name, $languages, $country = null, $options = [])
    {
        $result = [];
        foreach ($languages as $lang) {
            $params = [
                'address' => $name,
                'language' => $lang
            ];
            if (null != $country) {
                $params['country'] = $country;
            }
            $params = array_merge($params, $options);
            $command = $this->factory->createAddressCommand($params);
            $response = $command->send();
            if ($response->isOk()) {
                //var_dump($response->getResults()); exit;
                $result['data'][$lang]  = $this->formatCityResponse($response->getResults());
                $result['type']         = $this->getTypeResult($response->getResults());
                $result['place_id']     = $this->getPlaceId($response->getResults());
            }
        }
        return $result;
    }
}