<?php

namespace Admin\LanguageBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TranslationSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', TextType::class,[
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'width: 100%;'
                ],
                'error_bubbling' => true,
            ])
            ->add('language', EntityType::class, [
                'class' => 'Admin\LanguageBundle\Entity\Language',
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => true,
                'error_bubbling' => true,
                'choice_label' => 'name'
            ])
            ->add('value', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'width: 100%;'
                ],
                'error_bubbling' => true,
            ])
            ->add('term', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'width: 100%;'
                ],
                'error_bubbling' => true,
            ])
            ->add('page', HiddenType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'width: 100%;'
                ],
                'error_bubbling' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\LanguageBundle\Form\Entity\TranslationSearch',
        ));
    }

    public function getBlockPrefix()
    {
        return 'translation_search';
    }
}
