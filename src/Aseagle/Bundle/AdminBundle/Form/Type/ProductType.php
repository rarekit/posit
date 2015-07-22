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
use Aseagle\Bundle\AdminBundle\Form\Event\ProductSubscriber;

/**
 * ProductType
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class ProductType extends AbstractType {
    
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
            'label' => 'Product Name', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Product Name',
            ),
            'required' => true 
        ))->add('slug', null, array ( 
            'label' => 'Slug', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Slug' 
            ) 
        ))->add('sku', null, array ( 
            'label' => 'Product Sku', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Product Sku' 
            ) 
        ))->add('quantity', null, array ( 
            'label' => 'Product Quantity', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Product Quantity' 
            ) 
        ))->add('price', null, array ( 
            'label' => 'Price', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Price' 
            ) 
        ))->add('intro', null, array ( 
            'label' => 'Short Description', 
            'attr' => array ( 
                'class' => 'form-control tinymce', 
                'placeholder' => 'Short Description',   
                'data-theme' => 'simple'           
            ) 
        ))->add('description', null, array ( 
            'label' => 'Product Description', 
            'attr' => array ( 
                'class' => 'form-control tinymce', 
                'placeholder' => 'Product Description',
                'data-theme' => 'product' 
            ) 
        ))->add('supplement', null, array ( 
            'label' => 'Product Supplement', 
            'attr' => array ( 
                'class' => 'form-control tinymce', 
                'placeholder' => 'Product Supplement',
                'data-theme' => 'product' 
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
        ))->add('images', 'collection', array ( 
            'label' => 'Images',
            'type' => new ImageType(),            
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Images' 
            ),
            'allow_add' => true,
            'by_reference' => true,
            'allow_delete' => true
        ))->add('brand', null, array ( 
            'label' => 'Brand', 
            'property' => 'propertyName',
            'empty_value' => 'Select...',
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Brand' 
            ) 
        ))->add('tags', null, array ( 
            'label' => 'Tags', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Tags' 
            ) 
        ))->add('metaTitle', null, array ( 
            'label' => 'Meta Title', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Meta Title' 
            ) 
        ))->add('metaContent', 'textarea', array ( 
            'label' => 'Meta Description', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Meta Description' 
            ),
            'required' => false 
        ))->add('metaKeywords', null, array ( 
            'label' => 'Meta Keywords', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Meta Keywords' 
            ) 
        ))->add('showHomepage', null, array ( 
            'label' => 'Show on Homepage',
            'required' => false, 
            'attr' => array ( 
                'class' => 'form-control' 
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
        
        $builder->addEventSubscriber(new ProductSubscriber($this->container));
        
    }

    /*
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\AbstractType::setDefaultOptions()
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array ( 
            'data_class' => 'Aseagle\Bundle\EcommerceBundle\Entity\Product', 
        ));
    }

    /*
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName() {
        return 'product';
    }
}
