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

/**
 * OrderFilter
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class OrderFilter extends AbstractType {
   
    /*
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('fullname', null, array ( 
            'label' => 'Full Name', 
            'attr' => array ( 
                'class' => 'form-control form-filter input-sm', 
                'placeholder' => 'Full Name',
            ),
            'required' => false 
        ))->add('email', null, array ( 
            'label' => 'Email', 
            'attr' => array ( 
                'class' => 'form-control form-filter input-sm', 
                'placeholder' => 'Email' 
            ),
            'required' => false
        ))->add('phone', null, array ( 
            'label' => 'Phone', 
            'attr' => array ( 
                'class' => 'form-control form-filter input-sm', 
                'placeholder' => 'Phone Number' 
            ),
            'required' => false
        ))->add('total_from', 'text', array ( 
            'attr' => array ( 
                'class' => 'form-control form-filter input-sm', 
                'placeholder' => 'From' 
            ),
            'required' => false
        ))->add('total_to', 'text', array ( 
            'attr' => array ( 
                'class' => 'form-control form-filter input-sm', 
                'placeholder' => 'To' 
            ),
            'required' => false
        ))->add('created_from', 'date', array ( 
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
        ))->add('status', 'choice', array ( 
            'required' => false,
            'label' => 'Status',
            'empty_value' => 'Select...', 
            'choices' => array ( 
                '2' => 'Pending',
                '1' => 'Completed', 
                '0' => 'Closed' 
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
        return 'order';
    }
}
