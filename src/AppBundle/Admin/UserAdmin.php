<?php

namespace AppBundle\Admin;

use AppBundle\Entity\User;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('lastname', null, [
                'disabled' => true
            ])
            ->add('firstname', null, [
                'disabled' => true
            ])
            ->add('middlename', null, [
                'disabled' => true
            ])
            ->add('birthdate', "date", [
                'disabled' => true
            ])
            ->add('getsex', "text", [
                'label' => "Sex",
                'disabled' => true
            ])
            ->add('city', null, [
                'disabled' => true
            ])
            ->add('moderated', "choice", [
                'label' => 'moderated',
                'choices' => User::moderatedConditions(true),
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('moderated', 'doctrine_orm_string', [], 'choice', [
            'choices' => User::moderatedConditions(true),
        ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('getuserid', null, [
                'label' => 'user_id'
            ])
            ->addIdentifier('lastname')
            ->add('firstname')
            ->add('middlename')
            ->add('birthdate')
            ->add('getsex', null, [
                'label' => "Sex"
            ])
            ->add('city')
            ->add('images', 'sonata_type_collection', [
                'associated_property' => function ($item) {
                    return "img";
                }
            ])
            ->add('moderated', "choice", [
                'label'    => 'moderated',
                'editable' => true,
                'choices'  => User::moderatedConditions(),
            ]);
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('delete');
        $collection->remove('export');
    }
}
