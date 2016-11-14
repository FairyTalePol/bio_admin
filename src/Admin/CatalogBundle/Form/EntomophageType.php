<?php

namespace Admin\CatalogBundle\Form;

use Admin\CatalogBundle\Entity\ImageBase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntomophageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Название'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('norm', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Норма внесения в очагах'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('description', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Описание'
                ],
                'required' => false,
                'error_bubbling' => true
            ])
            ->add('prophylaxy', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Норма внесения превентивно'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('vermins', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\CatalogBundle\Entity\Vermin',
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false
            ])
            ->add('category', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\CatalogBundle\Entity\EntomophageCategory',
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_label' => 'name',
                'required' => true
            ])
            ->add('attachment_data', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'required' => false,
                'mapped' => false
            ])
            ->add('attachment');

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            /** @var ImageBase $entity */
            $entity = $event->getData();
            $form = $event->getForm();

            $imgContent = $form->get('attachment_data')->getData();

            $imgContent = preg_replace('/(data\:image\/[a-z]{3,4}\;base64\,)/', '', $imgContent, 1);
            $imgContent = base64_decode($imgContent);

            if ($imgContent) {
                $fPath = '/tmp/' . uniqid();
                file_put_contents($fPath, $imgContent);
                $attachment = new File($fPath);
                $entity->setAttachment($attachment);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getBlockPrefix()
    {
        return 'entomophage';
    }
}