<?php

namespace Admin\LanguageBundle\Form;

use Admin\LanguageBundle\Entity\Term;
use Admin\LanguageBundle\Entity\Translation;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var EntityManager $em */
        $em = $options['em'];

        $term_name = $options['data']->getTerm() ? $options['data']->getTerm()->getName() : '';

        $builder
            ->add('value', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Translation',
                    'style' => 'width: 100%; height: 200px;',
                ],
                'required' => true,
                'error_bubbling' => true,
            ])
            ->add('term_name', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Translation',
                    'style' => 'width: 100%;',
                ],
                'required' => true,
                'error_bubbling' => true,
                'mapped' => false,
                'data' => $term_name
            ]);
/*            ->add('term', new TermType(), [
                'by_reference' => true,
                'data_class' => 'Admin\LanguageBundle\Entity\Term',
                'error_bubbling' => true,
                'cascade_validation' => true,
                'em' => $em,
            ]);*/

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($em) {
            /** @var Translation $translation */
            $translation = $event->getForm()->getNormData();
            $term_name = $event->getForm()->get('term_name')->getNormData();

            /** @var Term $term */
            $term = $em->getRepository('AdminLanguageBundle:Term')->findOneBy([
                'name' => $term_name
            ]);

            if (!$term) {
                $term = new Term();

                $term->setName($term_name);
            }

            $translation->setTerm($term);
        });

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\LanguageBundle\Entity\Translation',
            'em' => null
        ));
    }

    public function getBlockPrefix()
    {
        return 'translation';
    }
}
