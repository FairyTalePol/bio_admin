<?php

namespace Admin\CatalogBundle\Form;

use Admin\CatalogBundle\Entity\ImageBase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlightType extends AbstractType
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
            ->add('description', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Описание'
                ],
                'required' => false,
                'error_bubbling' => true
            ])
            ->add('dis_description1', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Порог вредности'
                ],
                'required' => false,
                'error_bubbling' => true
            ])
            ->add('dis_description2', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Порог вредности'
                ],
                'required' => false,
                'error_bubbling' => true
            ])
            ->add('dis_description3', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Порог вредности'
                ],
                'required' => false,
                'error_bubbling' => true
            ])
            ->add('dis_description4', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Порог вредности'
                ],
                'required' => false,
                'error_bubbling' => true
            ])
            ->add('dis_description5', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Порог вредности'
                ],
                'required' => false,
                'error_bubbling' => true
            ])
            ->add('attachment_data', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control attachment_data',
                ],
                'required' => false,
                'mapped' => false
            ])
            ->add('category', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\CatalogBundle\Entity\BlightCategory',
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_label' => 'name',
                'required' => true
            ])
            ->add('attachment');

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            /** @var ImageBase $imageBase */
            $imageBase = $event->getData();
            $form = $event->getForm();

            $imgContent = $form->get('attachment_data')->getData();

            $imgContent = preg_replace('/(data\:image\/[a-z]{3,4}\;base64\,)/', '', $imgContent, 1);
            $imgContent = base64_decode($imgContent);

            if ($imgContent) {
                $fPath = '/tmp/' . uniqid(rand(0, 9999), true);
                file_put_contents($fPath, $imgContent);
                $attachment = new File($fPath);
                $imageBase->setAttachment($attachment);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => true
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getBlockPrefix()
    {
        return 'blight';
    }
}