<?php

namespace Admin\LanguageBundle\Form;

use Admin\LanguageBundle\Entity\Translation;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TranslationSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'Symfony\Component\Form\Extension\Core\Type\TextType',[
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'width: 100%;'
                ],
                'error_bubbling' => true,
            ])
            ->add('language', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\LanguageBundle\Entity\Language',
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => true,
                'error_bubbling' => true,
                'choice_label' => 'name'
            ])
            ->add('value', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'width: 100%;'
                ],
                'error_bubbling' => true,
            ])
            ->add('term', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'width: 100%;'
                ],
                'error_bubbling' => true,
            ])
            ->add('page', 'Symfony\Component\Form\Extension\Core\Type\HiddenType', [
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
