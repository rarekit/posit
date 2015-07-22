<?php

namespace Aseagle\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlockController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AseagleSiteBundle:Default:index.html.twig', array('name' => $name));
    }


    public function navAction()
    {
        return $this->render('AseagleSiteBundle:Block:nav.html.twig');
    }

    public function slideAction()
    {
        $bannerRepo = $this->get('banner_manager')->getRepository();
        $banners = $bannerRepo->getList(array('enabled'=>true, 'position'=>1), array(), 0, 6);

        return $this->render('AseagleSiteBundle:Block:slide.html.twig', array(
            'banners' => $banners
        ));
    }
}
