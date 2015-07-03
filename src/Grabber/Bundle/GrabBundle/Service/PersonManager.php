<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Service;


use Grabber\Bundle\GrabBundle\Entity\Person;
use Symfony\Component\HttpFoundation\ParameterBag;

class PersonManager extends BaseManager
{
    /**
     * @param array $data
     *
     * @return Person
     */
    public function create(array $data)
    {
        $bag = new ParameterBag($data);
        $person = new Person();
        $person->addName($bag->get('name'));
        $person->addAnnounce($bag->get('announce'));
        $person->addCategory($bag->get('category'));
        $person->addCity($bag->get('city'));
        $person->setCreated(new \DateTime());
        $person->setEmail($bag->get('email'));
        $person->setMsisdn($bag->get('msisdn'));
        $person->setUpdated(new \DateTime());

        $this->entityManager->persist($person);
        $this->entityManager->flush();

        return $person;
    }

    /**
     * @param string $msisdn
     *
     * @return null|Person
     */
    public function findByMsisdn($msisdn)
    {
        return $this->entityManager->getRepository(Person::clazz())->findOneBy(['msisdn' => $msisdn]);
    }
}