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

    /**
     * @param ParameterBag $params
     */
    public function process(ParameterBag $params)
    {
        $this->logger->addDebug('Init ' . $this->getName() . ' parse uri ' . $params->get('uri'));
        $response = $this->sendCommand($params->get('uri'), $params->get('pattern'));
        $this->logger->addDebug('Result ', $response->getData());
        $handleParams = new ParameterBag($params->get('handle'));
        foreach($response->getData() as $categoryData)
        {
            $category = $this->categoryManager->getCategory($categoryData['category']);
            $this->handler->setCategory($category);
            $handleParams->set('uri', $categoryData['uri']);

            $this->handler->process($handleParams);
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