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
     * @return string
     */
    protected function getPattern()
    {
        return $this->source->getConfig()['region']['pattern'];
    }

    private function createSourceRegion($url, $region)
    {
        if ($this->localityManager->hasSourceRegion($url)) {
            return ;
        }
        $this->localityManager->createSourceRegion($url, $this->source, $region);
    }

    /**
     * @throws \Exception
     */
    public function process()
    {
        /** @var Country $country */
        $country = $this->source->getCountry();
        $this->logger->addDebug('Init ' . $this->getName() . ' parse uri ' . $this->source->getUrl());
        $response = $this->sendCommand($this->source->getUrl(), $this->getPattern());
        $this->logger->addDebug('Result ', $response->getData());

        foreach ($response->getData() as $regionData) {
            $regionName   = $this->formatRegionName($regionData['region'], $country->getAreaName());
            $regionEntity = $this->localityManager->findRegion($regionName, $country);
            $this->createSourceRegion($regionData['uri'], $regionEntity);
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