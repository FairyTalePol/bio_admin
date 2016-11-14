<?php

namespace Admin\CatalogBundle\Form;

use Admin\CatalogBundle\Entity\Manufacturer;
use Admin\CatalogBundle\Entity\ManufacturerRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChemistryType extends AbstractType
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
                    'placeholder' => 'Концентрация препарата'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('substance', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Действующее вещество'
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
            ->add('prophylaxy')
            ->add('volume', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Объем'
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
            ->add('manufacturers', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\CatalogBundle\Entity\Manufacturer',
                'query_builder' => function (ManufacturerRepository $repo) {
                    return $repo->createQueryBuilder('m')
                        ->orderBy('m.name', 'ASC')
                        ->where('m.manufacturer_type = :manufacturer_type')
                        ->setParameter('manufacturer_type', Manufacturer::MANUFACTURER_TYPE_CHEMISTRY);
                },
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false
            ])
            ->add('category', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\CatalogBundle\Entity\ChemistryCategory',
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_label' => 'name',
                'required' => true
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
        return 'chemistry';
    }
}