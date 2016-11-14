<?php

namespace Admin\CatalogBundle\Form;

use Admin\CatalogBundle\Entity\Manufacturer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProviderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fio', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'ФИО'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('phone', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Контактный телефон'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('position', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Должность'
                ],
                'required' => false,
                'error_bubbling' => true
            ])
            ->add('email', 'Symfony\Component\Form\Extension\Core\Type\EmailType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Почтовый ящик'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('manufacturer', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\CatalogBundle\Entity\Manufacturer',
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_label' => 'name',
                'required' => false
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => true,
            'data_class' => 'Admin\CatalogBundle\Entity\Provider',
            'cascade_validation' => true
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getBlockPrefix()
    {
        return 'provider';
    }
}