<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Handler;

use Grabber\Bundle\GrabBundle\Entity\Region;
use Grabber\Bundle\GrabBundle\Service\CategoryManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class CategoryHandler
 *
 * @package Grabber\Bundle\GrabBundle\Handler
 */
class CategoryHandler extends AbstractHandler
{

    /**
     * @var CategoryManager
     */
    protected $categoryManager;

    public function setCategoryManager($categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    private function getUrl()
    {
        return $this->source->getUrl();
    }

    private function getPattern()
    {
        return $this->source->getConfig()['category']['pattern'];
    }

    public function process()
    {
        $this->logger->addDebug('Init ' . $this->getName() . ' parse uri ' . $this->getUrl());
        $response = $this->sendCommand($this->getUrl(), $this->getPattern());
        $this->logger->addDebug('Result ', $response->getData());
        dump($response);
        foreach($response->getData() as $categoryData)
        {
            //$category = $this->categoryManager->getCategory($categoryData['category']);
            dump($categoryData);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Category';
    }
}