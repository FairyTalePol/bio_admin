<?php

namespace Admin\ClientBundle\Form;

use Admin\ClientBundle\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('password', 'password', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Пароль'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('db_role', 'entity', [
                'class' => 'Admin\ClientBundle\Entity\DBRole',
                'property' => 'role',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Роль DB'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('role', 'choice', [
                'choices' => [
                    Client::ROLE_USER => 'Пользователь',
                    Client::ROLE_ADMIN => 'Администратор',
                    Client::ROLE_SUPER_ADMIN => 'Суперадминистратор'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Роль DB'
                ],
                'required' => true,
                'error_bubbling' => true
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\ClientBundle\Entity\Client'
        ));
    }

    public function getName()
    {
        return 'admin_clientbundle_clienttype';
    }
}
