<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\EntomophageCategory;
use Admin\CatalogBundle\Form\EntomophageCategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * EntomophageCategory API controller.
 *
 * @Route("/admin/catalog/entomophage-category")
 */
class EntomophageCategoryController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="entomophage_category",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/EntomophageCategory/index.html.twig")
     */
    public function indexAction()
    {
        $entomophage_categories = $this->getEntomophageCategoryRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'entomophage_categories' => $entomophage_categories
        ];
    }

    /**
     * @Route(
     *     path="/add",
     *     name="entomophage_category_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/EntomophageCategory/edit.html.twig")
     */
    public function addAction()
    {
        $entomophage_category = new EntomophageCategory();

        $form = $this->createForm(EntomophageCategoryType::class, $entomophage_category, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="entomophage_category_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/EntomophageCategory/edit.html.twig")
     * @param EntomophageCategory $entomophage_category
     * @return array
     */
    public function editAction(EntomophageCategory $entomophage_category)
    {
        return [
            'form' => $this->createForm(EntomophageCategoryType::class, $entomophage_category)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="entomophage_category_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/EntomophageCategory/edit.html.twig")
     * @param Request $request
     * @param EntomophageCategory $entomophage_category
     * @return array
     */
    public function updateAction(Request $request, EntomophageCategory $entomophage_category = null)
    {
        if (!$entomophage_category) {
            $entomophage_category = new EntomophageCategory();
        }

        $form = $this->createForm(EntomophageCategoryType::class, $entomophage_category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entomophage_category);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="entomophage_category_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param EntomophageCategory $entomophage_category
     * @return RedirectResponse
     */
    public function deleteAction(EntomophageCategory $entomophage_category)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($entomophage_category);
        $em->flush();

        return $this->redirect($this->generateUrl('entomophage_category'));
    }
}
