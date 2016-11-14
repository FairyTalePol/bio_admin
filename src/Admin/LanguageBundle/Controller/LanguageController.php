<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/24/14
 * Time: 4:31 PM
 */

namespace Admin\LanguageBundle\Controller;

use Admin\LanguageBundle\Entity\Language;
use Admin\LanguageBundle\Form\LanguageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * @Route("/", name="language")
     * @Method({"GET"})
     * @Template()
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
     * @Route("/delete/{id}", name="language_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @ParamConverter("language", class="AdminLanguageBundle:Language")
     * @param Language $language
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Language $language)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($language);
        $em->flush();

        return $this->redirect($this->generateUrl('language'));
    }

    /**
     * @Route("/add", name="language_add")
     * @Method({"GET", "POST"})
     * @Template("AdminLanguageBundle:Language:edit.html.twig")
     */
    public function addAction()
    {
        $language = new Language();

        $form = $this->createForm(new LanguageType(), $language, [
            'error_bubbling' => true,
        ]);

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/edit/{id}", name="language_edit")
     * @ParamConverter("language", class="AdminLanguageBundle:Language")
     * @Method({"GET", "POST"})
     * @Template()
     * @param Request $request
     * @param Language $language
     * @return array
     */
    public function editAction(Request $request, Language $language)
    {
        return [
            'form' => $this->createForm(new LanguageType(), $language)->createView(),
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="language_update")
     * @ParamConverter("language", class="AdminLanguageBundle:Language")
     * @Method({"POST"})
     * @Template("AdminLanguageBundle:Language:edit.html.twig")
     * @param Request $request
     * @param Language $language
     * @return array
     */
    public function updateAction(Request $request, Language $language = null)
    {
        if (!$language) {
            $language = new Language();
        }

        $form = $this->createForm(new LanguageType(), $language);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if ($language->getId())
                $em->merge($language);
            else
                $em->persist($language);

            $em->flush();
        }

        return [
            'form' => $form->createView(),
        ];
    }
} 