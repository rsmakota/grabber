<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\ORM;


use Doctrine\ORM\EntityRepository;
use Grabber\Bundle\GrabBundle\Entity\Country;
use Grabber\Bundle\GrabBundle\Entity\Region;

/**
 * Class RegionRepository
 *
 * @package Grabber\Bundle\GrabBundle\ORM
 */
class RegionRepository extends EntityRepository
{
    /**
     * @param string  $name
     * @param Country $country
     *
     * @return null|Region
     */
    public function findOneByName($name, Country $country)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select('r')
            ->from(Region::clazz(), 'r')
            ->Where('r.name = :name OR r.nativeName = :name OR r.secondNativeName = :name ')
            ->andWhere('r.country = :country')
            ->setMaxResults(1)
            ->setParameter(':country', $country)
            ->setParameter(':name', $name);

        return $builder->getQuery()->getOneOrNullResult();
    }
}