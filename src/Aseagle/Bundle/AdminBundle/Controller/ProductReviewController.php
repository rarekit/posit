<?php

/**
 * This file is part of the Aseagle package.
 *
 * (c) Quang Tran <quang.tran@aseagle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Aseagle\Bundle\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Aseagle\Bundle\CoreBundle\Helper\Html;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\CssSelector\Parser\Reader;

/**
 * ProductReviewController
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class ProductReviewController extends BaseController {

    
    /* (non-PHPdoc)
     * @see \Aseagle\Bundle\AdminBundle\Controller\BaseController::indexAction()
     */
    public function indexAction() {
        $manager = $this->getRequest()->get('_manager');
        if (NULL == $manager) {
            throw $this->createNotFoundException('Missing manager argument');
        }
        
        $form = $this->getRequest()->get('_form');
        if (NULL == $form) {
            throw $this->createNotFoundException('Missing form argument');
        }
             
        $columns = $this->getRequest()->get('_columns', '[]');
        if (NULL == $columns) {
            throw $this->createNotFoundException('Missing form argument');
        }
        
        $class = $this->getRequest()->get('_class');
        if (NULL == $form) {
            throw $this->createNotFoundException('Missing form argument');
        }
        
        $filterForm = $this->createForm(new $form());
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST' && $request->isXmlHttpRequest()) {
            $msgDenied = $this->container->get('translator')->trans('Permission Denied');
            switch ($request->get('customActionName')) {
                case 'delete' :
                    if ($this->get('user_acl')->isAllow('DELETE', $class)) {
                        $response = $this->delete($request->get('id', array ()), $manager);
                    } else {
                        $response['customActionMessage'] = $msgDenied;
                    }
                    break;
                case 'publish' :
                    if ($this->get('user_acl')->isAllow('EDIT', $class)) {
                        $response = $this->setStatus($request->get('id', array ()), $manager);
                    } else {
                        $response['customActionMessage'] = $msgDenied;
                    }
                    break;
                case 'unpublished' :
                    if ($this->get('user_acl')->isAllow('EDIT', $class)) {
                        $response = $this->setStatus($request->get('id', array ()), $manager, 'unpublished');
                    } else {
                        $response['customActionMessage'] = $msgDenied;
                    }
                    break;
                default :
            }
            
            $filterForm->bind($request);
            $filters = $filterForm->getData();
            
            $jsonFilters = $this->getRequest()->get('_filter', '{}');
            $options = json_decode($jsonFilters, true);
            $filters = array_merge($filters, $options);
            $filters['product'] = $request->get('pid');
            
            $offset = $this->getRequest()->get('start', 0);
            $limit = $this->getRequest()->get('length', $this->container->getParameter('item_per_page'));
            
            $order = array ();
            $orderMapping = json_decode($columns, true);
            $orderColumnNumber = $request->get('order', array ( 
                'column' => 1 
            ));
            if ($orderColumnNumber [0] ['column'] && isset($orderMapping [$orderColumnNumber [0] ['column']])) {
                $orderDir = $request->get('order', array ( 
                    'dir' => 'asc' 
                ));
                $order [$orderMapping [$orderColumnNumber [0] ['column']]] = $orderDir [0] ['dir'];
            }
            
            $entities = $this->get($manager)->getRepository()->getList($filters, $order, $limit, $offset);
            $total = $this->get($manager)->getRepository()->getTotal($filters);
            $grid = $this->grid($entities);
            
            $response ['data'] = $grid;
            $response ['recordsFiltered'] = $total;
            $response ['recordsTotal'] = $total;
            
            return new Response(json_encode($response));
        }   

        return new Response(json_encode(array()));
    }
    
    /* (non-PHPdoc)
     * @see \Aseagle\Bundle\AdminBundle\Controller\BaseController::grid()
     */
    protected function grid($entities) {
        $grid = array ();
        foreach ($entities as $item) {
            $grid [] = array (
                '<input type="checkbox" name="ids[]" class="check" value="' . $item->getId() . '"/>',
                is_object($item->getCreated()) ? $item->getCreated()->format('d/m/Y') : '',
                is_object($item->getUser()) ? $item->getUser()->getFullname() : '_',
                $item->getMessage(),
                Html::showStatusInTable($this->container, $item->getEnabled()),
                Html::showActionButtonsInTable($this->container, array (
                    'delete' => $this->generateUrl('admin_product_new', array (
                        'id' => $item->getId()
                    ))
                ))
            );
        }
        
        return $grid;
    }    
    
    public function deleteAction() {
        
    }
   
}
