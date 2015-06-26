<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Service;

use Grabber\Bundle\GrabBundle\Entity\Category;

/**
 * Class CategoryManager
 *
 * @package Grabber\Bundle\GrabBundle\Service
 */
class CategoryManager extends BaseManager
{
    /**
     * @param array $data
     *
     * @return Category
     */
    public function createCategory($data)
    {
        $category = new Category();
        $category->setName($data['name']);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        return $category;
    }

}