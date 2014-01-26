<?php

namespace Videl\TNGroupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TNGroupBundle:Default:index.html.twig');
    }
}
