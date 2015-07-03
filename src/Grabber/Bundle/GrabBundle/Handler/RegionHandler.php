<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Handler;

use Grabber\Bundle\GrabBundle\Entity\Country;
use Grabber\Bundle\GrabBundle\Service\LocalityManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class RegionHandler
 *
 * @package Grabber\Bundle\GrabBundle\Handler
 */
class RegionHandler extends AbstractHandler
{
    /**
     * @var LocalityManager
     */
    protected $localityManager;

    /**
     * @param LocalityManager $localityManager
     */
    public function setLocalityManager($localityManager)
    {
        $this->localityManager = $localityManager;
    }

    /**
     * @param string $name
     * @param string $area
     *
     * @return string
     */
    protected function formatRegionName($name, $area)
    {
        if (strpos($name, $area) !== false) {
            return $name;
        }

        return $name." ".$area;
    }

    /**
     * @param ParameterBag $params
     *
     * @throws \Exception
     */
    public function process(ParameterBag $params)
    {
        /** @var Country $country */
        $country = $this->source->getCountry();
        $response = $this->sendCommand($params->get('uri'), $params->get('pattern'));
        $handleParams = new ParameterBag($params->get('handle'));
        foreach ($response->getData() as $regionData) {
            $regionName = $this->formatRegionName($regionData['region'], $country->getAreaName());
            $region = $this->localityManager->findRegion($regionName, $country);
            $this->handler->setRegion($region);
            $handleParams->set('uri', $regionData['uri']);

            $this->handler->process($handleParams);
            var_dump($region->getName());
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Region';
    }
}