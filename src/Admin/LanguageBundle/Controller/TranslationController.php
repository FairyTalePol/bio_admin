<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/24/14
 * Time: 4:31 PM
 */

namespace Admin\LanguageBundle\Controller;

use Admin\LanguageBundle\Entity\Language;
use Admin\LanguageBundle\Entity\Term;
use Admin\LanguageBundle\Entity\Translation;
use Admin\LanguageBundle\Form\Entity\TranslationSearch;
use Admin\LanguageBundle\Form\TranslationSearchType;
use Admin\LanguageBundle\Form\TranslationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auth controller.
 *
 * @Route("/admin/translation")
 */
class TranslationController extends DefaultController
{
    /**
     * @Route("/", name="translation")
     * @Route("/{language_id}", name="translation2")
     * @ParamConverter("language", class="AdminLanguageBundle:Language", options={"id" = "language_id"})
     * @Method({"GET", "POST"})
     * @Template()
     * @param Language $language
     * @return array
     */
    public function indexAction(Request $request, Language $language = null)
    {
        if ($language == null) {
            $language = $this->getLanguageRepository()->findOneBy([], [
                'name' => 'ASC'
            ]);
        }

        $translationSearch = new TranslationSearch();
        $translationSearch->setLanguage($language);

        $form = $this->createForm(new TranslationSearchType(), $translationSearch);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
        }

        list ($translations, $pages) = $this->getTranslationRepository()->search($translationSearch);

        return [
            'translations' => $translations,
            'form' => $form->createView(),
            'pages' => $pages
        ];
    }

    /**
     * @Route("/delete/{id}", name="translation_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @ParamConverter("translation", class="AdminLanguageBundle:Translation")
     * @param Translation $translation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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
     * @Route("/add/{language_id}", name="translation_add")
     * @ParamConverter("language", class="AdminLanguageBundle:Language", options={"id" = "language_id"})
     * @Method({"GET", "POST"})
     * @Template("AdminLanguageBundle:Translation:edit.html.twig")
     * @param Language $language
     * @return array
     */
    public function addAction(Language $language)
    {
        $translation = new Translation();

        $form = $this->createForm(new TranslationType(), $translation, [
            'error_bubbling' => true,
        ]);

        return [
            'form' => $form->createView(),
            'language' => $language
        ];
    }

    /**
     * @Route("/edit/{id}", name="translation_edit")
     * @ParamConverter("translation", class="AdminLanguageBundle:Translation")
     * @Method({"GET", "POST"})
     * @Template()
     * @param Request $request
     * @param Translation $translation
     * @return array
     */
    public function editAction(Request $request, Translation $translation)
    {
        return [
            'form' => $this->createForm(new TranslationType(), $translation)->createView(),
            'language' => $translation->getLanguage()
        ];
    }

    /**
     * @Route("/update/{id}", name="translation_update")
     * @ParamConverter("translation", class="AdminLanguageBundle:Translation")
     * @Method({"POST"})
     * @Template("AdminLanguageBundle:Translation:edit.html.twig")
     * @param Request $request
     * @param Translation $translation
     * @return array
     */
    public function updateAction(Request $request, Translation $translation = null)
    {
        $form = $this->createForm(new TranslationType(), $translation, [
            'em' => $this->getDoctrine()->getManager()
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->merge($translation);

            $em->flush();
        }

        return [
            'form' => $form->createView(),
            'language' => $translation->getLanguage()
        ];
    }

    /**
     * @Route("/create/{language_id}", name="translation_create")
     * @ParamConverter("language", class="AdminLanguageBundle:Language", options={"id" = "language_id"})
     * @Method({"POST"})
     * @Template("AdminLanguageBundle:Translation:edit.html.twig")
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

        $form = $this->createForm(new TranslationType(), $translation, [
            'cascade_validation' => true,
            'em' => $this->getDoctrine()->getManager(),
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($translation);

            $em->flush();
        }

        return [
            'form' => $form->createView(),
            'language' => $translation->getLanguage()
        ];
    }
}