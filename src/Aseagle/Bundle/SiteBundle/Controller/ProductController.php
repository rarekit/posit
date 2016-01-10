<?php

namespace Aseagle\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Aseagle\Bundle\ContentBundle\Entity\Category;

class ProductController extends Controller
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

    public function detailAction()
    {
        $productId = $this->getRequest()->get('productId'); 
        $product = $this->get('manager_factory')->get('product', $productId); 
        if (!$product) {
            throw $this->createNotFoundException('Missing manager argument');
        }  
        
        return $this->render('AseagleSiteBundle:Product:detail.html.twig', array(
            'product' => $product  
        ));
    }
    
    /*
     * listByCategoryId
     * fetch list of product by category
     *
     */
    public function listByCategoryAction()
    {
        $catId = $this->getRequest()->get('catId');
        $products = $this->get('manager_factory')
            ->create('product')
            ->getProducts();

        return $this->render('AseagleSiteBundle:Product:list-by-category.html.twig', array(
            'products' => $products,
        ));
    }

    public function listAction()
    {
        $limit = $this->container->getParameter('front_item_per_page');
        $page = $this->getRequest()->get('page', 1);
        $offset = ($page - 1) > 0 ? ($page - 1) * $limit : 0;
        
        $products = $this->get('product_manager')
            ->getProducts(array(), array(), $offset, $limit);

        return $this->render('AseagleSiteBundle:Product:list.html.twig', array(
            'products' => $products,
        ));
    }


    /*
     * categories block action
     */
    public function categoriesAction()
    {
        $catId = $this->getRequest()->get('catId');
        $categories = $this->get('category_manager')->getRepository()
            ->findBy(array('enabled' => true, 'type'=> Category::TYPE_PRODUCT), array('ordering'=>'ASC'));
        $catalogs = array(); 
        foreach ($categories as $category) {
            if ($category->getParent() == null) {
                $catalogs[0][] = $category;
            } else {
                $catalogs[$category->getParent()->getId()][] = $category;
            }
        }
        return $this->render('AseagleSiteBundle:Product:category.html.twig', array(
           'categories' => $catalogs
        )); 
    }
}

