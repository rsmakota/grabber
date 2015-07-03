<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Grabber\Bundle\GrabBundle\Handler;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class PageHandler
 *
 * @package Grabber\Bundle\GrabBundle\Handler
 */
class PageHandler extends AbstractHandler
{
    protected $subPageUri = '/page/';

    /**
     * @param string $subPageUri
     */
    public function setSubPageUri($subPageUri)
    {
        $this->subPageUri = $subPageUri;
    }

    /**
     * @param string $uri
     *
     * @return string
     */
    protected function formatUri($uri)
    {
        return $uri.$this->subPageUri;
    }

    /**
     * @param ParameterBag $params
     */
    public function process(ParameterBag $params)
    {
        $response = $this->sendCommand($params->get('uri'), $params->get('pattern'));
        $handleParams = new ParameterBag($params->get('handle'));
        $data = $response->getData();
        $handleParams->set('pages', $data['pages']);
        $handleParams->set('uri', $this->formatUri($params->get('uri')));

        $this->handler->process($handleParams);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Page';
    }
}