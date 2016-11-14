<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\VerminCategory;
use Admin\CatalogBundle\Form\VerminCategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * VerminCategory API controller.
 *
 * @Route("/admin/catalog/vermin-category")
 */
class VerminCategoryController extends DefaultController
{
    /**
     * @Route("/", name="vermin_category")
     * @Method({"GET"})
     * @Template()
     */
    public function indexAction()
    {
        $vermin_categories = $this->getVerminCategoryRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'vermin_categories' => $vermin_categories
        ];
    }

    /**
     * @Route("/add", name="vermin_category_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:VerminCategory:edit.html.twig")
     */
    public function addAction()
    {
        $vermin_category = new VerminCategory();

        $form = $this->createForm(new VerminCategoryType(), $vermin_category, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="vermin_category_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param VerminCategory $vermin_category
     * @return array
     */
    public function editAction(VerminCategory $vermin_category)
    {
        return [
            'form' => $this->createForm(new VerminCategoryType(), $vermin_category)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="vermin_category_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:VerminCategory:edit.html.twig")
     * @param Request $request
     * @param VerminCategory $vermin_category
     * @return array
     */
    public function updateAction(Request $request, VerminCategory $vermin_category = null)
    {
        if (!$vermin_category) {
            $vermin_category = new VerminCategory();
        }

        $form = $this->createForm(new VerminCategoryType(), $vermin_category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vermin_category);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/delete/{id}", name="vermin_category_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param VerminCategory $vermin_category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(VerminCategory $vermin_category)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($vermin_category);
        $em->flush();

        return $this->redirect($this->generateUrl('vermin_category'));
    }
}
