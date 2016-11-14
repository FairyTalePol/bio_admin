<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Form\SubstrateCategoryType;
use Admin\CatalogBundle\Entity\SubstrateCategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * SubstrateCategory API controller.
 *
 * @Route("/admin/catalog/substrate-category")
 */
class SubstrateCategoryController extends DefaultController
{
    /**
     * @Route("/", name="substrate_category")
     * @Method({"GET"})
     * @Template()
     */
    public function indexAction()
    {
        $substrate_categories = $this->getSubstrateCategoryRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'substrate_categories' => $substrate_categories
        ];
    }

    /**
     * @Route("/add", name="substrate_category_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:SubstrateCategory:edit.html.twig")
     */
    public function addAction()
    {
        $substrate_category = new SubstrateCategory();

        $form = $this->createForm(new SubstrateCategoryType(), $substrate_category, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="substrate_category_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param SubstrateCategory $substrate_category
     * @return array
     */
    public function editAction(SubstrateCategory $substrate_category)
    {
        return [
            'form' => $this->createForm(new SubstrateCategoryType(), $substrate_category)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="substrate_category_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:SubstrateCategory:edit.html.twig")
     * @param Request $request
     * @param SubstrateCategory $substrate_category
     * @return array
     */
    public function updateAction(Request $request, SubstrateCategory $substrate_category = null)
    {
        if (!$substrate_category) {
            $substrate_category = new SubstrateCategory();
        }

        $form = $this->createForm(new SubstrateCategoryType(), $substrate_category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($substrate_category);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/delete/{id}", name="substrate_category_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param SubstrateCategory $substrate_category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(SubstrateCategory $substrate_category)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($substrate_category);
        $em->flush();

        return $this->redirect($this->generateUrl('substrate_category'));
    }
}
