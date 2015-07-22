<?php 
/*
 * This file is part of the Aseagle package.
 *
 * (c) Quang Tran <quang.tran@aseagle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Aseagle\Bundle\AdminBundle\Form\Event;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityRepository;
use Aseagle\Bundle\CoreBundle\Helper\Html;

/**
 * ProductSubscriber
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class ProductSubscriber implements EventSubscriberInterface
{
    protected $container;
    
    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) 
    {
        $this->container = $container;
    }
    
    /**
     * @return multitype:string 
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_BIND => 'preBind',
            FormEvents::POST_BIND => 'postBind'
        );
    }

    /**
     * @param FormEvent $event
     */
    public function preBind(FormEvent $event)
    {
        $data = $event->getData();
        $data['slug'] = empty($data['slug']) ? Html::slugify($data['name']) : Html::slugify($data['slug']);
          
        /* Replacing new value for slug field */
        $event->setData($data);
    }
    
    /**
     * @param FormEvent $event
     */
    public function postBind(FormEvent $event) {
        $product = $event->getData();
        $thumbnail = '';
        $first = false;
        foreach ($product->getImages() as $image) {
            if (!$first) {
                $thumbnail = $image->getPath();
                $first = true;
            }            
            if ($image->getThumb()) {
                $thumbnail = $image->getPath();
            }            
            $image->setProduct($product);
            $this->container->get('product_manager')->save($image, false);
        }
        $product->setThumbnail($thumbnail);        
        
        if (null !== $product->getId()) {
            $imageDir = $this->container->get('kernel')->getRootDir() . '/../web/uploads/products/';
            
            $imgList = $this->container->get('product_image_manager')
                        ->getRepository()
                        ->findBy(array('product'=>$product->getId()));
            
            foreach ($imgList as $image) {
                if (!$product->getImages()->contains($image)) {
                    if (file_exists($imageDir . $image->getPath())) {
                        unlink($imageDir . $image->getPath());
                    }
                    $this->container->get('product_manager')->delete($image);
                } 
            }
        }
    }   
  
}