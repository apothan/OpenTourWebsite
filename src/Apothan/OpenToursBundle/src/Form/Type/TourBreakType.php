<?php

namespace Apothan\OpenToursBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TourBreakType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start', DateType::class)
            ->add('end', DateType::class)
            ->add('sellamounts', CollectionType::class, array(
        	    'entry_type' => TourSellType::class,
        	    'prototype' => true,
        	    'by_reference' => false,
            ))
            ->add('mon', CheckboxType::class)
            ->add('tue', CheckboxType::class)
            ->add('wed', CheckboxType::class)
            ->add('thu', CheckboxType::class)
            ->add('fri', CheckboxType::class)
            ->add('sat', CheckboxType::class)
            ->add('sun', CheckboxType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \Apothan\OpenToursBundle\Entity\SellDateBreak::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'ot_tourbreak';
    }
}
