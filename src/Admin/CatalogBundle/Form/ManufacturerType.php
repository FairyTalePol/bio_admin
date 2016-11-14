<?php

namespace Admin\CatalogBundle\Form;

use Admin\CatalogBundle\Entity\Manufacturer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ManufacturerType extends AbstractType
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
            ->add('manufacturer_type', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', [
                'choices' => [
                    Manufacturer::MANUFACTURER_TYPE_CHEMISTRY => 'Химия',
                    Manufacturer::MANUFACTURER_TYPE_CULTURES => 'Культуры',
                    Manufacturer::MANUFACTURER_TYPE_ENTOMOPHAGES => 'Энтомофаги',
                    Manufacturer::MANUFACTURER_TYPE_SUBSTRATES => 'Субстраты'
                ],
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
            ->add('attachment')
            ->add('providers', 'Symfony\Component\Form\Extension\Core\Type\CollectionType', [
                'type' => new ProviderType(),
                'allow_add' => true,
                'allow_delete' => true,
                'error_bubbling' => true,
                'by_reference' => true,
                'cascade_validation' => true,
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ]);

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
            'csrf_protection' => true,
            'cascade_validation' => false
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getBlockPrefix()
    {
        return 'manufacturer';
    }
}