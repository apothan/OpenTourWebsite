<?php

namespace Apothan\OpenToursBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddTourType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,array(
                "label" => "Tour Name"))
            ->add('description', TextareaType::class)
            ->add('submit', SubmitType::class,array(
                "label" => "Create"))
            
        ;
    }

    public function getBlockPrefix()
    {
        return 'ot_addtour';
    }
}
