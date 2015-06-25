<?php
/**
 * Created by PhpStorm.
 * User: rodion
 * Date: 25.06.15
 * Time: 22:42
 */

namespace Grabber\Bundle\GrabBundle\ORM;


use Doctrine\ORM\EntityRepository;
use Grabber\Bundle\GrabBundle\Entity\City;
use Grabber\Bundle\GrabBundle\Entity\Region;

class CityRepository extends EntityRepository
{
    /**
     * @param string $name
     * @param Region $region
     *
     * @return null|City
     */
    public function findOneByName($name, Region $region)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select('c')
            ->from(City::clazz(), 'c')
            ->Where('(c.name = :name OR c.nativeName = :name OR c.secondNativeName)')
            ->andWhere('region = :region')
            ->setMaxResults(1)
            ->setParameter(':region', $region)
            ->setParameter(':name', $name);

        return $builder->getQuery()->getOneOrNullResult();
    }
}