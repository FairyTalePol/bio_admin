<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Form\SubstrateCategoryType;
use Admin\CatalogBundle\Entity\SubstrateCategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * SubstrateCategory API controller.
 *
 * @Route("/admin/catalog/substrate-category")
 */
class SubstrateCategoryController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="substrate_category",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/SubstrateCategory/index.html.twig")
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
     * @Route(
     *     path="/add",
     *     name="substrate_category_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/SubstrateCategory/edit.html.twig")
     */
    public function addAction()
    {
        $substrate_category = new SubstrateCategory();

        $form = $this->createForm(SubstrateCategoryType::class, $substrate_category, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="substrate_category_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/SubstrateCategory/edit.html.twig")
     * @param SubstrateCategory $substrate_category
     * @return array
     */
    public function editAction(SubstrateCategory $substrate_category)
    {
        return [
            'form' => $this->createForm(SubstrateCategoryType::class, $substrate_category)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="substrate_category_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/SubstrateCategory/edit.html.twig")
     * @param Request $request
     * @param SubstrateCategory $substrate_category
     * @return array
     */
    public function updateAction(Request $request, SubstrateCategory $substrate_category = null)
    {
        if (!$substrate_category) {
            $substrate_category = new SubstrateCategory();
        }

        $form = $this->createForm(SubstrateCategoryType::class, $substrate_category);

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
     * @Route(
     *     path="/delete/{id}",
     *     name="substrate_category_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param SubstrateCategory $substrate_category
     * @return RedirectResponse
     */
    public function deleteAction(SubstrateCategory $substrate_category)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($substrate_category);
        $em->flush();

        return $this->redirect($this->generateUrl('substrate_category'));
    }
}
