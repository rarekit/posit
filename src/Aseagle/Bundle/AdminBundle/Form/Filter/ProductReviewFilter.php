<?php

/*
 * This file is part of the Aseagle package.
 *
 * (c) Quang Tran <quang.tran@aseagle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Aseagle\Bundle\AdminBundle\Form\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityRepository;
use Aseagle\Bundle\ContentBundle\Entity\Category;

/**
 * ProductReviewFilter
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class ProductReviewFilter extends AbstractType {
   
    /*
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('message', 'text', array ( 
            'attr' => array ( 
                'class' => 'form-control form-filter input-sm', 
                'placeholder' => 'Content' 
            ),
            'required' => false 
        ))->add('user', 'text', array ( 
            'attr' => array ( 
                'class' => 'form-control form-filter input-sm', 
                'placeholder' => 'User' 
            ),
            'required' => false 
        ))
        ->add('created_from', 'date', array ( 
            'required' => false, 
            'widget' => 'single_text', 
            'format' => 'dd/MM/yyyy', 
            'attr' => array ( 
                'readonly' => true, 
                'class' => 'form-control form-filter input-sm', 
                'placeholder' => 'From' 
            ) 
        ))->add('created_to', 'date', array ( 
            'required' => false, 
            'widget' => 'single_text', 
            'format' => 'dd/MM/yyyy', 
            'attr' => array ( 
                'readonly' => true, 
                'class' => 'form-control form-filter input-sm', 
                'placeholder' => 'To' 
            ) 
        ))->add('enabled', 'choice', array ( 
            'required' => false, 
            'empty_value' => 'Status', 
            'choices' => array ( 
                '1' => 'Publish', 
                '0' => 'Un-publish' 
            ), 
            'attr' => array ( 
                'class' => 'form-control form-filter input-sm' 
            ) 
        ));
    }
  
    /*
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName() {
        return 'product_review';
    }
}
