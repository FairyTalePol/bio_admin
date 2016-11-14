<?php

namespace Admin\CatalogBundle\Form;

use Admin\CatalogBundle\Entity\CultureRepository;
use Admin\CatalogBundle\Entity\Manufacturer;
use Admin\CatalogBundle\Entity\ManufacturerRepository;
use Admin\CatalogBundle\Entity\SubstrateCategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubstrateCategoryManufacturerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('substrate_category', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\CatalogBundle\Entity\SubstrateCategory',
                'query_builder' => function (SubstrateCategoryRepository $repo) {
                    return $repo->createQueryBuilder('sc')
                        ->orderBy('sc.name', 'ASC');
                },
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('manufacturer', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
                'class' => 'Admin\CatalogBundle\Entity\Manufacturer',
                'query_builder' => function (ManufacturerRepository $repo) {
                    return $repo->createQueryBuilder('m')
                        ->orderBy('m.name', 'ASC')
                        ->where('m.manufacturer_type = :manufacturer_type')
                        ->setParameter('manufacturer_type', Manufacturer::MANUFACTURER_TYPE_SUBSTRATES);
                },
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control',
                ],
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
        return 'substrate_category_manufacturer';
    }
}