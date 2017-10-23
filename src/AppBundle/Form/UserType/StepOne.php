<?php

namespace AppBundle\Form\UserType;

use AppBundle\Entity\User;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StepOne extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {      
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('middlename')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => User::class,
            'validation_groups' => "basic_data",
        ]);
    }
}
