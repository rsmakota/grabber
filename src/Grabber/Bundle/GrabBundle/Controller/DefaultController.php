<?php

namespace Grabber\Bundle\GrabBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GrabberGrabBundle:Default:index.html.twig', array('name' => $name));
    }
}
