<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Handler;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class AnnounceListHandler
 *
 * @package Grabber\Bundle\GrabBundle\Handler
 */
class AnnounceListHandler extends AbstractHandler
{

    /**
     * @param ParameterBag $params
     */
    public function process(ParameterBag $params)
    {
        $handleParams = new ParameterBag($params->get('handle'));
        for($i = 0; $i < $params->get('pages'); $i++) {
            $uri = $params->get('uri') . $i;
            $this->logger->addDebug('Init ' . $this->getName() . ' parse uri ' . $params->get('uri'));
            $response = $this->sendCommand($uri, $params->get('pattern'));
            $this->logger->addDebug('Result ', $response->getData());
            foreach ($response->getData() as $announceListData) {
                $handleParams->set('uri', $announceListData['uri']);

                $this->handler->process($handleParams);
            }
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'AnnounceList';
    }
}