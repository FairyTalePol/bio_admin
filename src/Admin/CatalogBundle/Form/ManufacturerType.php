<?php

namespace Admin\CatalogBundle\Form;

use Admin\CatalogBundle\Entity\ImageBase;
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
            ])
            ->add('attachment_data', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control vermin_attachment',
                ],
                'required' => false,
                'mapped' => false
            ])
            ->add('attachment_data2', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control vermin_attachment2',
                ],
                'required' => false,
                'mapped' => false
            ])
            ->add('attachment_data3', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control vermin_attachment3',
                ],
                'required' => false,
                'mapped' => false
            ])
            ->add('attachment_data4', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control vermin_attachment4',
                ],
                'required' => false,
                'mapped' => false
            ])
            ->add('video', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ссылка на видео'
                ],
                'required' => false,
                'error_bubbling' => true
            ])
            ->add('attachment')
            ->add('attachment2')
            ->add('attachment3')
            ->add('attachment4');

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

            $imgContent = $form->get('attachment_data2')->getData();
            $imgContent = preg_replace('/(data\:image\/[a-z]{3,4}\;base64\,)/', '', $imgContent, 1);
            $imgContent = base64_decode($imgContent);

            if ($imgContent) {
                $fPath = '/tmp/' . uniqid(rand(0, 9999), true);
                file_put_contents($fPath, $imgContent);
                $attachment = new File($fPath);
                $imageBase->setAttachment2($attachment);
            }

            $imgContent = $form->get('attachment_data3')->getData();
            $imgContent = preg_replace('/(data\:image\/[a-z]{3,4}\;base64\,)/', '', $imgContent, 1);
            $imgContent = base64_decode($imgContent);

            if ($imgContent) {
                $fPath = '/tmp/' . uniqid(rand(0, 9999), true);
                file_put_contents($fPath, $imgContent);
                $attachment = new File($fPath);
                $imageBase->setAttachment3($attachment);
            }

            $imgContent = $form->get('attachment_data4')->getData();
            $imgContent = preg_replace('/(data\:image\/[a-z]{3,4}\;base64\,)/', '', $imgContent, 1);
            $imgContent = base64_decode($imgContent);

            if ($imgContent) {
                $fPath = '/tmp/' . uniqid(rand(0, 9999), true);
                file_put_contents($fPath, $imgContent);
                $attachment = new File($fPath);
                $imageBase->setAttachment4($attachment);
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