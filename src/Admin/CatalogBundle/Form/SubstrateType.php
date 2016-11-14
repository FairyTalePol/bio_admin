<?php

namespace Admin\CatalogBundle\Form;

use Admin\CatalogBundle\Entity\Substrate;
use Admin\CatalogBundle\Entity\Manufacturer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubstrateType extends AbstractType
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
            ->add('size', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Размер'
                ],
                'required' => true,
                'error_bubbling' => true
            ])
            ->add('substrate_type', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', [
                'choices' => [
                    Substrate::SUBSTRATE_TYPE_BLOCK => 'Блок',
                    Substrate::SUBSTRATE_TYPE_DISK => 'Диск',
                    Substrate::SUBSTRATE_TYPE_KUB => 'Куб',
                    Substrate::SUBSTRATE_TYPE_MAT => 'Мат',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('substrate_category_manufacturer', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\CatalogBundle\Entity\SubstrateCategoryManufacturer',
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
        return 'substrate';
    }
}