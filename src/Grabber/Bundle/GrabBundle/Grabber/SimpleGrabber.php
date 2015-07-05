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
use Monolog\Logger;
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
     * @var Logger
     */
    protected $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Source $source
     */
    public function setSource($source)
    {
        $this->source = $source;
        if ($this->handle) {
            $this->handle->setSource($source);
        }
    }

    /**
     * @return ParameterBag
     */
    protected function getProcessBag()
    {
        $config = $this->source->getConfig();
        $bag = new ParameterBag($config['handle']);
        $bag->set('uri', $this->source->getUrl());

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
        $this->logger->debug('Start grabbing for source '.$this->source->getName(), $this->getProcessBag()->all());
        $this->handle->process($this->getProcessBag());
    }
}