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

/**
 * OrderController
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class OrderController extends BaseController {

    
    /* (non-PHPdoc)
     * @see \Aseagle\Bundle\AdminBundle\Controller\BaseController::indexAction()
     */
    public function indexAction() {
        return parent::indexAction();
    }
    
    /* (non-PHPdoc)
     * @see \Aseagle\Bundle\AdminBundle\Controller\BaseController::grid()
     */
    protected function grid($entities) {
        $grid = array ();
        foreach ($entities as $item) {
            $grid [] = array (
                '<input type="checkbox" name="ids[]" class="check" value="' . $item->getId() . '"/>',
                $item->getFullname(),
                $item->getEmail(),
                $item->getPhone(),
                $item->getTotal(),
                is_object($item->getCreated()) ? $item->getCreated()->format('d/m/Y') : '',
                Html::showStatusOrder($this->container, $item->getStatus()),
                Html::showActionButtonsInTable($this->container, array (
                    'edit' => $this->generateUrl('admin_order_new', array (
                        'id' => $item->getId()
                    ))
                ))
            );
        }
        
        return $grid;
    }

}
