<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TourCategoriesType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categories', CollectionType::class, array(
        	    'entry_type' => TourCategoryType::class,
        	    'allow_add' => true,
        	    'allow_delete' => true,
        	    'prototype' => true,
        	    'by_reference' => false,
            ))
            ->add('submit', SubmitType::class,array(
                "label" => "Update"))
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \App\Entity\Tour::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'ot_tourcategories';
    }
}
