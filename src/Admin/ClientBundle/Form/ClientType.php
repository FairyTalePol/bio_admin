<?php

namespace Admin\ClientBundle\Form;

use Admin\ClientBundle\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'Symfony\Component\Form\Extension\Core\Type\EmailType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('password', 'Symfony\Component\Form\Extension\Core\Type\PasswordType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Пароль'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('db_role', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\ClientBundle\Entity\DBRole',
                'property' => 'role',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Роль DB'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('role', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', [
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\ClientBundle\Entity\Client'
        ));
    }

    public function getBlockPrefix()
    {
        return 'admin_clientbundle_clienttype';
    }
}
