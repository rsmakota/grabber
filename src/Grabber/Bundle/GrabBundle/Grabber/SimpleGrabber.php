<?php
/**
 * Created by PhpStorm.
 * User: rodion
 * Date: 02.07.15
 * Time: 22:10
 */

namespace Grabber\Bundle\GrabBundle\Grabber;


use Grabber\Bundle\GrabBundle\Entity\Source;
use Grabber\Bundle\GrabBundle\Handler\HandlerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class SimpleGrabber
 *
 * @package Grabber\Bundle\GrabBundle\Grabber
 */
class SimpleGrabber implements GrabberInterface
{
    /**
     * @var HandlerInterface
     */
    protected $handle;
    /**
     * @var Source
     */
    protected $source;

    /**
     * @param Source $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return ParameterBag
     */
    protected function getProcessBag()
    {
        $config = $this->source->getConfig();
        $bag = new ParameterBag($config['handle']);
        $bag->set('uri', $this->source->getUrl());
        $bag->set('country', $this->source->getCountry());

        return $bag;
    }

    /**
     * @param HandlerInterface $handle
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    }

    public function grab()
    {
        $this->handle->process($this->getProcessBag());
    }
}