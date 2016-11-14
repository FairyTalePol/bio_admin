<?php

namespace Admin\CatalogBundle\Form;

use Admin\CatalogBundle\Entity\Manufacturer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VarietyType extends AbstractType
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
            ->add('yield', 'Symfony\Component\Form\Extension\Core\Type\NumberType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Урожайность'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('form', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Форма'
                ],
                'required' => false,
                'error_bubbling' => true
            ])
            ->add('color', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Цвет'
                ],
                'required' => false,
                'error_bubbling' => true
            ])
            ->add('culture_manufacturer', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\CatalogBundle\Entity\CultureManufacturer',
//                'query_builder' => function (ProvinceRepository $repo) {
//                    return $repo->createQueryBuilder('p')
//                        ->orderBy('p.name', 'ASC');
//                },
                'choice_label' => 'manufacturer.name',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('attachment_data', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => false,
                'mapped' => false
            ])
            ->add('attachment');

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            /** @var Manufacturer $manufacturer */
            $manufacturer = $event->getData();
            $form = $event->getForm();

            $imgContent = $form->get('attachment_data')->getData();

            $imgContent = preg_replace('/(data\:image\/[a-z]{3,4}\;base64\,)/', '', $imgContent, 1);
            $imgContent = base64_decode($imgContent);

            if ($imgContent) {
                $fPath = '/tmp/' . uniqid();
                file_put_contents($fPath, $imgContent);
                $attachment = new File($fPath);
                $manufacturer->setAttachment($attachment);
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
        return 'variety';
    }
}