<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\VerminCategory;
use Admin\CatalogBundle\Form\VerminCategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * VerminCategory API controller.
 *
 * @Route("/admin/catalog/vermin-category")
 */
class VerminCategoryController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="vermin_category",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/VerminCategory/index.html.twig")
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
     * @Route(
     *     path="/add",
     *     name="vermin_category_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/VerminCategory/edit.html.twig")
     */
    public function addAction()
    {
        $vermin_category = new VerminCategory();

        $form = $this->createForm(VerminCategoryType::class, $vermin_category, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="vermin_category_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/VerminCategory/edit.html.twig")
     * @param VerminCategory $vermin_category
     * @return array
     */
    public function editAction(VerminCategory $vermin_category)
    {
        return [
            'form' => $this->createForm(VerminCategoryType::class, $vermin_category)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="vermin_category_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/VerminCategory/edit.html.twig")
     * @param Request $request
     * @param VerminCategory $vermin_category
     * @return array
     */
    public function updateAction(Request $request, VerminCategory $vermin_category = null)
    {
        if (!$vermin_category) {
            $vermin_category = new VerminCategory();
        }

        $form = $this->createForm(VerminCategoryType::class, $vermin_category);

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
     * @Route(
     *     path="/delete/{id}",
     *     name="vermin_category_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param VerminCategory $vermin_category
     * @return RedirectResponse
     */
    public function deleteAction(VerminCategory $vermin_category)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($vermin_category);
        $em->flush();

        return $this->redirect($this->generateUrl('vermin_category'));
    }
}
