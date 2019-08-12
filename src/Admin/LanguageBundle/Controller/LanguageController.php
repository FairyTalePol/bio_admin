<?php

namespace Admin\LanguageBundle\Controller;

use Admin\LanguageBundle\Entity\Language;
use Admin\LanguageBundle\Form\LanguageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auth controller.
 *
 * @Route("/admin/language")
 */
class LanguageController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="language",
     *     methods={"GET"}
     * )
     * @Template("@AdminLanguage/Language/index.html.twig")
     */
    public function indexAction()
    {
        $languages = $this->getLanguageRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'languages' => $languages,
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="language_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @ParamConverter("language", class="AdminLanguageBundle:Language")
     * @param Language $language
     * @return RedirectResponse
     */
    public function deleteAction(Language $language)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($language);
        $em->flush();

        return $this->redirect($this->generateUrl('language'));
    }

    /**
     * @Route(
     *     path="/add",
     *     name="language_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminLanguage/Language/edit.html.twig")
     */
    public function addAction()
    {
        $language = new Language();

        $form = $this->createForm(
            LanguageType::class,
            $language,
            [
                'error_bubbling' => true,
            ]
        );

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="language_edit",
     *     methods={"GET", "POST"}
     * )
     * @ParamConverter("language", class="AdminLanguageBundle:Language")
     * @Template("@AdminLanguage/Language/edit.html.twig")
     * @param Request $request
     * @param Language $language
     * @return array
     */
    public function editAction(Request $request, Language $language)
    {
        return [
            'form' => $this->createForm(LanguageType::class, $language)->createView(),
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="language_update",
     *     methods={"POST"}
     * )
     * @ParamConverter("language", class="AdminLanguageBundle:Language")
     * @Template("@AdminLanguage/Language/edit.html.twig")
     * @param Request $request
     * @param Language $language
     * @return array
     */
    public function updateAction(Request $request, Language $language = null)
    {
        if (!$language) {
            $language = new Language();
        }

        $form = $this->createForm(LanguageType::class, $language);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if ($language->getId()) {
                $em->merge($language);
            } else {
                $em->persist($language);
            }

            $em->flush();
        }

        return [
            'form' => $form->createView(),
        ];
    }
} 
