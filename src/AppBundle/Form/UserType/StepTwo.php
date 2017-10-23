<?php

namespace AppBundle\Form\UserType;

use AppBundle\Entity\User;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class StepTwo extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {      
         $builder
            ->add('birthdate', DateType::class, [
                'years' => range(date('Y') - 100, date('Y') - 3),
            ])
            ->add('sex', ChoiceType::class, [
                'choices'  => User::sexConditions(),
            ])
            ->add('city')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => User::class,
            'validation_groups' => "advanced_data",
        ]);
    }
}
