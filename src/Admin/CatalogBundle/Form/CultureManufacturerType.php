<?php

namespace Admin\CatalogBundle\Form;

use Admin\CatalogBundle\Entity\CultureRepository;
use Admin\CatalogBundle\Entity\Manufacturer;
use Admin\CatalogBundle\Entity\ManufacturerRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CultureManufacturerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('culture', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\CatalogBundle\Entity\Culture',
                'query_builder' => function (CultureRepository $repo) {
                    return $repo->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_label' => 'name',
            ])
            ->add('manufacturer', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\CatalogBundle\Entity\Manufacturer',
                'query_builder' => function (ManufacturerRepository $repo) {
                    return $repo->createQueryBuilder('m')
                        ->orderBy('m.name', 'ASC')
                        ->where('m.manufacturer_type = :manufacturer_type')
                        ->setParameter('manufacturer_type', Manufacturer::MANUFACTURER_TYPE_CULTURES);
                },
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_label' => 'name',
                'required' => true
            ]);
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
        return 'culture_manufacturer';
    }
}