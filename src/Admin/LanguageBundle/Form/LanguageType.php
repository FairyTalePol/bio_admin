<?php

namespace Admin\LanguageBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LanguageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Language name',
                ],
                'required' => true,
                'error_bubbling' => true,
            ])
            ->add('locale', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Locale',
                ],
                'required' => true,
                'error_bubbling' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\LanguageBundle\Entity\Language'
        ));
    }

    public function getBlockPrefix()
    {
        return 'language';
    }
}
