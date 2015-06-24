<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */
namespace Grabber\Bundle\GoogleApiBundle\Command\GeoCode;

use Grabber\Bundle\GoogleApiBundle\Command\GeoCode\Response\Fail;
use Grabber\Bundle\GoogleApiBundle\Command\GeoCode\Response\Success;
use GuzzleHttp\ClientInterface;

/**
 * Class AddressCommand
 *
 * The street address that you want to geocode, in the format used by the national postal service of the country concerned.
 * Additional address elements such as business names and unit, suite or floor numbers should be avoided.
 *
 * @package Grabber\Bundle\GoogleApiBundle\Command\GeoCode
 */
class AddressCommand
{
    /**
     * @var ClientInterface
     */
    protected $client;

    protected $method = 'GET';

    protected $uri;

    //////////// Required parameters ////////////
    /**
     * The street address that you want to geocode, in the format used by the national postal service of the country concerned.
     * Additional address elements such as business names and unit, suite or floor numbers should be avoided.
     * @var string
     */
    protected $address;

    protected $commandName = "address";

    //////////// Optional parameters ////////////
    /**
     * The bounds parameter defines the latitude/longitude coordinates.
     * [["latitude"=>"34.172684", "longitude"=>"-118.604794"],["latitude"=>"34.236144", "longitude"=>"-118.500938"]]
     * In a request coordinates will separate by a pipe (|). ***&bounds=34.172684,-118.604794|34.236144,-118.500938
     * @var array
     */
    protected $bounds;

    /**
     * Your application's API key. This key identifies your application for purposes of quota management.
     * @var string
     */
    protected $key;
    /**
     * The language in which to return results.
     * If language is not supplied, the geocoder will attempt to use the native language of the domain from which the request is sent wherever possible.
     * @var string
     */
    protected $language;
    /**
     * The region code, specified as a ccTLD ("top-level domain") two-character value.
     * A geocoding request for "Toledo" with region=es (Spain) will return the Spanish city.
     * @var string
     */
    protected $region;

    protected $optionParams = ['bounds', 'key', 'language', 'region'];

    ////////// components /////////
    /* components — The component filters, separated by a pipe (|).
       Each component filter consists of a component:value pair and will fully restrict the results from the geocoder
    */
    protected $componentsData = [
        "route"              => "route",
        "locality"           => "locality",
        "administrativeArea" => "administrative_area",
        "postalCode"         => "postal_code",
        "country"            => "country"
    ];
    /**
     * Matches long or short name of a route
     * @var string
     */
    protected $route;

    /**
     * Matches against both locality and sub locality types.
     * @var string
     */
    protected $locality;

    /**
     * administrative_area matches all the administrative_area levels.
     * @var string
     */
    protected $administrativeArea;
    /**
     * postal_code matches postal_code and postal_code_prefix.
     * @var string
     */
    protected $postalCode;
    /**
     * matches a country name or a two letter ISO 3166-1 country code.
     * @var string
     */
    protected $country;

    /**
     * @param ClientInterface $client
     * @param array           $data
     */
    public function __construct(ClientInterface $client, array $data)
    {
        $this->client = $client;
        foreach ($data as $property=>$value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getCommandName()
    {
        return $this->commandName;
    }

    public function getBounds()
    {
        return $this->bounds;
    }

    public function setBounds($bounds)
    {
        $this->bounds = $bounds;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region)
    {
        $this->region = $region;
    }

    public function getComponentsData()
    {
        return $this->componentsData;
    }

    public function setComponentsData($componentsData)
    {
        $this->componentsData = $componentsData;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function setRoute($route)
    {
        $this->route = $route;
    }

    public function getLocality()
    {
        return $this->locality;
    }

    public function setLocality($locality)
    {
        $this->locality = $locality;
    }

    public function getAdministrativeArea()
    {
        return $this->administrativeArea;
    }

    public function setAdministrativeArea($administrativeArea)
    {
        $this->administrativeArea = $administrativeArea;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Prepares data from options parameters
     * @return array
     */
    protected function formatOptionData()
    {
        $data = [];
        foreach ($this->optionParams as $property) {
            if (null != $this->{$property}) {
                $data[$property] = $this->{$property};
            }
        }

        return $data;
    }

    /**
     * Prepares data from components parameter
     * @return array
     */
    protected function formatComponentsData()
    {
        $data = [];
        foreach ($this->componentsData as $property=>$param) {
            if (null != $this->{$property}) {
                $data[] = $param.":".$this->{$property};
            }
        }
        if (!empty($data)) {
            $data = ["components" => implode('|', $data)];
        }

        return $data;
    }

    /**
     * Prepares data from geocoding request
     * @return array
     */
    protected function formatData()
    {
        return array_merge(["address" => $this->address], $this->formatOptionData(), $this->formatComponentsData());
    }

    /**
     * @return Fail|Success
     * @throws \Exception
     */
    public function send()
    {
        $data = $this->formatData();
        $response = $this->client->request($this->method, $this->uri."?".http_build_query($data));

        if (200 != $response->getStatusCode()) {
            throw new \Exception('Bad response, http status code is '.$response->getStatusCode());
        }

        $data = json_decode($response->getBody()->getContents(), true);
        if (isset($data['error_message'])) {
            return new Fail($data);
        }

        return new Success($data);

    }
}