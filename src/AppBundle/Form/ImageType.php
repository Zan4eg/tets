<?php

namespace AppBundle\Form;

use AppBundle\Entity\Image;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ImageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {      
        $builder
            ->add('image', FileType::class, [
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => Image::class,
        ));
    }
}
