<?php

namespace Aseagle\Bundle\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AseagleEcommerceBundle:Default:index.html.twig', array('name' => $name));
    }
}
