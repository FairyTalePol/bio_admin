<?php

namespace Admin\LanguageBundle\Form;

use Admin\LanguageBundle\Entity\Term;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TermType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var EntityManager $em */
        $em = $options['em'];

        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Term',
                    'style' => 'width: 100%;'
                ],
                'error_bubbling' => true,
                'property_path' => 'name'
            ]);

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($em) {
            /** @var Term $term */
            $term = $event->getForm()->getNormData();

            $term->setName(mb_strtolower($term->getName(), 'UTF-8'));

            $term = $em->getRepository('AdminLanguageBundle:Term')->findOneBy([
                'name' => $term->getName()
            ]);

            if ($term) {
                $event->setData($term);
            }
        });

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\LanguageBundle\Entity\Term',
            'em' => null
        ));
    }

    public function getBlockPrefix()
    {
        return 'term';
    }
}
