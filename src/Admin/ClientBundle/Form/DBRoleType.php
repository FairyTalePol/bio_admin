<?php

namespace Admin\ClientBundle\Form;

use Admin\ClientBundle\Entity\DBRole;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DBRoleType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    /** @var DBRole $dbRole */
    $dbRole = $options['data'];

    $builder
      ->add('role', 'text', [
        'attr' => [
          'class' => 'form-control',
          'placeholder' => 'Название роли'
        ],
        'required' => true,
        'error_bubbling' => true
      ])
      ->add('password', 'password', [
        'attr' => [
          'class' => 'form-control',
          'placeholder' => 'Пароль'
        ],
        'required' => $dbRole->getId() === null,
        'error_bubbling' => true
      ])
      ->add('domain', 'text', [
        'attr' => [
          'class' => 'form-control',
          'placeholder' => 'Домен'
        ],
        'required' => true,
        'error_bubbling' => true
      ]);
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Admin\ClientBundle\Entity\DBRole'
    ));
  }

  public function getName()
  {
    return 'admin_clientbundle_dbroletype';
  }
}
