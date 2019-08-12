<?php

namespace Admin\LanguageBundle\Controller;

use Admin\LanguageBundle\Entity\Language;
use Admin\LanguageBundle\Entity\Term;
use Admin\LanguageBundle\Entity\Translation;
use Admin\LanguageBundle\Form\Entity\TranslationSearch;
use Admin\LanguageBundle\Form\TranslationSearchType;
use Admin\LanguageBundle\Form\TranslationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Valid;

/**
 * Auth controller.
 *
 * @Route("/admin/translation")
 */
class TranslationController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="translation",
     *     methods={"GET", "POST"}
     * )
     * @Route(
     *     path="/{language_id}",
     *     name="translation2",
     *     methods={"GET", "POST"}
     * )
     * @ParamConverter("language", class="AdminLanguageBundle:Language", options={"id" = "language_id"})
     * @Template("@AdminLanguage/Translation/index.html.twig")
     * @param Request $request
     * @param Language $language
     * @return array
     */
    public function indexAction(Request $request, Language $language = null)
    {
        if ($language == null) {
            $language = $this->getLanguageRepository()->findOneBy(
                [],
                [
                    'name' => 'ASC',
                ]
            );
        }

        $translationSearch = new TranslationSearch();
        $translationSearch->setLanguage($language);

        $form = $this->createForm(TranslationSearchType::class, $translationSearch);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
        }

        list ($translations, $pages) = $this->getTranslationRepository()->search($translationSearch);

        return [
            'translations' => $translations,
            'form' => $form->createView(),
            'pages' => $pages,
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="translation_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @ParamConverter("translation", class="AdminLanguageBundle:Translation")
     * @param Translation $translation
     * @return RedirectResponse
     */
    public function deleteAction(Translation $translation)
    {
        $language_id = $translation->getLanguage()->getId();

        $em = $this->getDoctrine()->getManager();

        $em->remove($translation);
        $em->flush();

        return $this->redirect($this->generateUrl('translation2', ['language_id' => $language_id]));
    }

    /**
     * @Route(
     *     path="/add/{language_id}",
     *     name="translation_add",
     *     methods={"GET", "POST"}
     * )
     * @ParamConverter("language", class="AdminLanguageBundle:Language", options={"id" = "language_id"})
     * @Template("@AdminLanguage/Translation/edit.html.twig")
     * @param Language $language
     * @return array
     */
    public function addAction(Language $language)
    {
        $translation = new Translation();

        $form = $this->createForm(
            TranslationType::class,
            $translation,
            [
                'error_bubbling' => true,
            ]
        );

        return [
            'form' => $form->createView(),
            'language' => $language,
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="translation_edit",
     *     methods={"GET", "POST"}
     * )
     * @ParamConverter("translation", class="AdminLanguageBundle:Translation")
     * @Template("@AdminLanguage/Translation/edit.html.twig")
     * @param Request $request
     * @param Translation $translation
     * @return array
     */
    public function editAction(Request $request, Translation $translation)
    {
        return [
            'form' => $this->createForm(TranslationType::class, $translation)->createView(),
            'language' => $translation->getLanguage(),
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     name="translation_update",
     *     methods={"POST"}
     * )
     * @ParamConverter("translation", class="AdminLanguageBundle:Translation")
     * @Template("@AdminLanguage/Translation/edit.html.twig")
     * @param Request $request
     * @param Translation $translation
     * @return array
     */
    public function updateAction(Request $request, Translation $translation = null)
    {
        $form = $this->createForm(
            TranslationType::class,
            $translation,
            [
                'em' => $this->getDoctrine()->getManager(),
            ]
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->merge($translation);

            $em->flush();
        }

        return [
            'form' => $form->createView(),
            'language' => $translation->getLanguage(),
        ];
    }

    /**
     * @Route(
     *     path="/create/{language_id}",
     *     name="translation_create",
     *     methods={"POST"}
     * )
     * @ParamConverter("language", class="AdminLanguageBundle:Language", options={"id" = "language_id"})
     * @Template("@AdminLanguage/Translation/edit.html.twig")
     * @param Request $request
     * @param Language $language
     * @return array
     * @internal param Translation $translation
     */
    public function createAction(Request $request, Language $language)
    {
        $translation = new Translation();

        $translation
            ->setLanguage($language)
            ->setTerm(new Term());

        $form = $this->createForm(
            TranslationType::class,
            $translation,
            [
                'constraints' => new Valid(),
                'em' => $this->getDoctrine()->getManager(),
            ]
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($translation);

            $em->flush();
        }

        return [
            'form' => $form->createView(),
            'language' => $translation->getLanguage(),
        ];
    }
}
