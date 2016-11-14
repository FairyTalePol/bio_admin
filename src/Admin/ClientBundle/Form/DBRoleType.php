<?php

namespace Admin\ClientBundle\Form;

use Admin\ClientBundle\Entity\DBRole;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DBRoleType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    /** @var DBRole $dbRole */
    $dbRole = $options['data'];

    $builder
      ->add('role', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
        'attr' => [
          'class' => 'form-control',
          'placeholder' => 'Название роли'
        ],
        'required' => true,
        'error_bubbling' => true
      ])
      ->add('password', 'Symfony\Component\Form\Extension\Core\Type\PasswordType', [
        'attr' => [
          'class' => 'form-control',
          'placeholder' => 'Пароль'
        ],
        'required' => $dbRole->getId() === null,
        'error_bubbling' => true
      ])
      ->add('domain', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
        'attr' => [
          'class' => 'form-control',
          'placeholder' => 'Домен'
        ],
        'required' => true,
        'error_bubbling' => true
      ]);
  }

    public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Admin\ClientBundle\Entity\DBRole'
    ));
  }

    public function getBlockPrefix()
  {
    return 'admin_clientbundle_dbroletype';
  }
}
