<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Service;

use Grabber\Bundle\GrabBundle\Entity\Category;
use Grabber\Bundle\GrabBundle\Entity\Subcategory;

/**
 * Class CategoryManager
 *
 * @package Grabber\Bundle\GrabBundle\Service
 */
class CategoryManager extends BaseManager
{
    /**
     * @param array $name
     *
     * @return Category
     */
    public function createCategory($name)
    {
        $category = new Category();
        $category->setName($name);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        return $category;
    }

    /**
     * @param string   $name
     * @param Category $category
     *
     * @return Subcategory
     */
    protected function createSubcategory($name, Category $category)
    {
        $subcategory = new Subcategory();
        $subcategory->setName($name);
        $subcategory->setCategory($category);
        $this->entityManager->persist($subcategory);
        $this->entityManager->flush();

        return $category;
    }

    /**
     * @param string $name
     *
     * @return Category
     */
    public function getCategory($name)
    {
        $category = $this->entityManager->getRepository(Category::clazz())->findOneBy(['name' => $name]);
        if (null != $category) {
            return $category;
        }

        return $this->createCategory($name);
    }

    /**
     * @param string   $name
     * @param Category $category
     *
     * @return Subcategory
     */
    public function getSubcategory($name, Category $category)
    {
        $subcategory = $this->entityManager->getRepository(Subcategory::clazz())->findOneBy(['name' => $name, 'category'=>$category]);
        if (null != $subcategory) {
            return $subcategory;
        }

        return $this->createSubcategory($name, $category);
    }


}