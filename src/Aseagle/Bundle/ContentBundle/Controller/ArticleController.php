<?php

/**
 * This file is part of the Aseagle package.
 *
 * (c) Quang Tran <quang.tran@aseagle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Aseagle\Bundle\ContentBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Aseagle\Bundle\CoreBundle\Helper\Html;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Aseagle\Bundle\ContentBundle\Entity\Content;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Aseagle\Bundle\CoreBundle\Controller\BaseController;

/**
 * ArticleController
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class ArticleController extends BaseController {

    /**
     * indexAction
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
                '<a href="'.$this->generateUrl('content_article_new', array ('id' => $item->getId())).'">' . $item->getTitle() . '</a>',
                is_object($item->getAuthor()) ? $item->getAuthor()->getFullname() : '_',
                (NULL != $item->getPageView()) ? $item->getPageView() : 0,
                is_object($item->getCreated()) ? $item->getCreated()->format('d/m/Y') : '',
                Html::showStatusInTable($this->container, $item->getEnabled()),
                Html::showActionButtonsInTable($this->container, array (
                    'edit' => $this->generateUrl('content_article_new', array (
                        'id' => $item->getId()
                    ))
                ))
            );
        }
        
        return $grid;
    }
}
