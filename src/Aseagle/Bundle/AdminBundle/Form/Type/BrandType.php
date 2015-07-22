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
use Aseagle\Bundle\ContentBundle\Entity\Category;

/**
 * BrandType
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class BrandType extends AbstractType {
    
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
        $builder->add('name', null, array ( 
            'label' => 'Brand Name', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Brand Name',
            ),
            'required' => true 
        ))->add('slug', null, array ( 
            'label' => 'Slug', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Slug' 
            ) 
        ))->add('categories', null, array ( 
            'label' => 'Categories',
            'property' => 'propertyName',
            'class' => 'AseagleContentBundle:Category',
            "expanded" => true,
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('o')
                    ->where('o.type = :type')
                    ->setParameter(':type', Category::TYPE_PRODUCT)
                    ->orderBy('o.root, o.lft, o.ordering', 'ASC');
            },
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Categories' 
            ) 
        ))->add('intro', null, array ( 
            'label' => 'Introduction', 
            'attr' => array ( 
                'class' => 'form-control tinymce', 
                'placeholder' => 'Introduction',
                'data-theme' => 'simple' 
            ) 
        ))->add('picture', 'hidden', array ( 
            'label' => 'Brand Picture', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Picture',
                'data-type' => 'elfinder-input-field'
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
        
    }

    /*
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\AbstractType::setDefaultOptions()
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array ( 
            'data_class' => 'Aseagle\Bundle\EcommerceBundle\Entity\Brand', 
        ));
    }

    /*
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName() {
        return 'brand';
    }
}
