<?php

namespace AppBundle\Form\UserType;

use AppBundle\Entity\User;

use AppBundle\Form\ImageType;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class StepThree extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {      
        $builder
            ->add('images', CollectionType::class, [
                'entry_type'    => ImageType::class,
                'label'         => 'Загрузите изображения',
                'entry_options' => [
                    'label' => false
                ]
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
