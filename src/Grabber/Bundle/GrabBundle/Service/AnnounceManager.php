<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Grabber\Bundle\GrabBundle\Service;


use Grabber\Bundle\GrabBundle\Entity\Announce;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class AnnounceManager
 *
 * @package Grabber\Bundle\GrabBundle\Service
 */
class AnnounceManager extends BaseManager
{
    /**
     * @param array $data
     *
     * @return Announce
     */
    public function create(array $data)
    {
        $bag = new ParameterBag($data);
        $announce = new Announce();
        $announce->setCreated($bag->get('created', new \DateTime()));
        $announce->setCategory($bag->get('category'));
        $announce->setSource($bag->get('source'));
        $announce->setIndex($bag->get('index'));
        $announce->setUri($bag->get('uri'));

        $this->entityManager->persist($announce);
        $this->entityManager->flush();

        return $announce;
    }

    /**
     * @param integer $index
     *
     * @return boolean
     */
    public function hasIndex($index)
    {
        if ($this->entityManager->getRepository(Announce::clazz())->findOneBy(['index' => $index])) {
            return true;
        }

        return false;
    }
}