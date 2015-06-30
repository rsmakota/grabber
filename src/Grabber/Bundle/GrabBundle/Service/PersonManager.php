<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Service;


use Grabber\Bundle\GrabBundle\Entity\Person;

class PersonManager extends BaseManager
{
    public function createPerson()
    {
        $person = new Person();

    }
}