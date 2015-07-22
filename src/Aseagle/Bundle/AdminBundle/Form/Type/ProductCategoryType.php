<?php

/*
 * This file is part of the Aseagle package.
 *
 * (c) Quang Tran <quang.tran@aseagle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Aseagle\Bundle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityRepository;
use Aseagle\Bundle\AdminBundle\Form\Event\CategorySubscriber;
use Aseagle\Bundle\ContentBundle\Entity\Category;
use Aseagle\Bundle\AdminBundle\Form\Event\ProductCategorySubscriber;

/**
 * ProductCategoryType
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class ProductCategoryType extends AbstractType {
    
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Constructor
     * 
     * @param ContainerInterface $container            
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /*
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title', null, array ( 
            'label' => 'Title', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Title',
            ),
            'required' => true 
        ))->add('slug', null, array ( 
            'label' => 'Slug', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Slug' 
            ) 
        ))->add('picture', 'hidden', array ( 
            'label' => 'Picture', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Picture',
                'data-type' => 'elfinder-input-field'
            ) 
        ))->add('parent', null, array ( 
            'label' => 'Parent Category',
            'property' => 'propertyName',
            'class' => 'AseagleContentBundle:Category',
            'empty_value' => "Select...",
            'query_builder' => function(EntityRepository $er) {
                $qBuider = $er->createQueryBuilder('o')                  
                    ->andWhere('o.enabled = 1')
                    ->andWhere('o.type = :type')->setParameter(':type', Category::TYPE_PRODUCT)
                    ->orderBy('o.root, o.lft, o.ordering', 'ASC');
                                
                return $qBuider;
            },
            
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Category' 
            ) 
        ))->add('description', null, array ( 
            'label' => 'Description', 
            'attr' => array ( 
                'class' => 'form-control tinymce', 
                'placeholder' => 'Description',
                'data-theme' => 'simple' 
            ) 
        ))->add('ordering', null, array ( 
            'label' => 'Order', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Order' 
            ) 
        ))->add('enabled', 'choice', array ( 
            'label' => 'Status',
            'required' => false, 
            'empty_value' => 'Select...', 
            'choices' => array ( 
                '1' => 'Publish', 
                '0' => 'Un-publish' 
            ), 
            'attr' => array ( 
                'class' => 'form-control' 
            ) 
        ));
        
        $builder->addEventSubscriber(new ProductCategorySubscriber($this->container));
        
    }

    /*
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\AbstractType::setDefaultOptions()
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array ( 
            'data_class' => 'Aseagle\Bundle\ContentBundle\Entity\Category', 
        ));
    }

    /*
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName() {
        return 'category';
    }
}
