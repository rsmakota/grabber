<?php
/**
 * Created by PhpStorm.
 * User: rodion
 * Date: 25.06.15
 * Time: 22:54
 */

namespace Grabber\Bundle\GoogleApiBundle\Service;

/**
 * Interface GeoManagerInterface
 * @package Grabber\Bundle\GoogleApiBundle\Service
 */
interface GeoManagerInterface {
    /**
     * @param string $name
     * @param array  $languages
     * @param string $country
     * @param array  $options    - administrativeArea is the same as area
     *
     * @return array
     */
    public function findPlace($name, $languages, $country = null, $options = []);
}