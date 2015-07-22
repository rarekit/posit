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
use Aseagle\Bundle\EcommerceBundle\Entity\Image;

/**
 * ImageType
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class ImageType extends AbstractType {
    /*
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', null, array ( 
            'label' => 'Name', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Name',
                'data-image-label' => ''
            ),
            'required' => true 
        ))->add('path', 'hidden', array ( 
            'label' => 'Path', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Path',
                'data-image-path' => ''
            ) 
        ))->add('ordering', null, array ( 
            'label' => 'Ordering', 
            'attr' => array ( 
                'class' => 'form-control', 
                'placeholder' => 'Ordering' 
            )
        ))->add('thumb', 'checkbox', array ( 
            'label' => 'Thumb',
            'required' => false,           
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
            'data_class' => 'Aseagle\Bundle\EcommerceBundle\Entity\Image', 
        ));
    }

    /*
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName() {
        return 'image';
    }
}
