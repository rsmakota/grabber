<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Handler;

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
     * @param ParameterBag $params
     *
     * @throws \Exception
     */
    public function process(ParameterBag $params)
    {
        if ($params->get('name') != $this->getName() ) {
            return $this->handler->process($params);
        }
        $response = $this->sendCommand($params->get('uri'), $params->get('pattern'));
        if (!$response->isSuccess()) {
            return;
        }

        foreach ($response->getData() as $category) {
            $handleParams = new ParameterBag($params->get('handle'));
            $handleParams->set('uri', $category['uri']);
            $this->handler->process($handleParams);
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