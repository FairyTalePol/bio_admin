<?php
/**
 * Created by PhpStorm.
 * User: Dima S.
 * Date: 22.04.14
 * Time: 11:42
 */

namespace Admin\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', [
            'attr' => [
                'class' => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                'placeholder' => 'Имя',
                'aria-invalid' => false
            ],
            'label' => 'Имя',
            'error_bubbling' => true
        ]);

        $builder->add('email', 'email', [
            'attr' => [
                'class' => 'wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email',
                'placeholder' => 'Email',
                'aria-invalid' => false
            ],
            'label' => 'E-mail',
            'error_bubbling' => true
        ]);

        $builder->add('tel', 'text', [
            'attr' => [
                'class' => 'wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-tel',
                'placeholder' => 'Номер телефона',
                'aria-invalid' => false
            ],
            'label' => 'Телефон',
            'error_bubbling' => true
        ]);

        $builder->add('body', 'textarea', [
            'attr' => [
                'class' => 'wpcf7-form-control wpcf7-textarea',
                'cols' => 40,
                'rows' => 10,
                'placeholder' => 'Дополнительная информация о предприятии',
                'aria-invalid' => false
            ],
            'label'  => 'Сообщение',
            'required' => false,
            'error_bubbling' => true
        ]);

    }

    public function getName()
    {
        return 'contact';
    }
} 