<?php

namespace Aseagle\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Aseagle\Bundle\ContentBundle\Entity\Category;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $categoryRepo = $this->get('category_manager')->getRepository();
        $categories = $categoryRepo->getList(
            array('enabled' => true, 'type' => Category::TYPE_PRODUCT), 
            array('ordering'=>'ASC')
        );

        return $this->render('AseagleSiteBundle:Default:index.html.twig', array(
            'categories' => $categories
        ));
    }
}
