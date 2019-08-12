<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\ChemistryCategory;
use Admin\CatalogBundle\Form\ChemistryCategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * ChemistryCategory API controller.
 *
 * @Route("/admin/catalog/chemistry-category")
 */
class ChemistryCategoryController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="chemistry_category",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/ChemistryCategory/index.html.twig")
     */
    public function indexAction()
    {
        $chemistry_categories = $this->getChemistryCategoryRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'chemistry_categories' => $chemistry_categories,
        ];
    }

    /**
     * @Route(
     *     path="/add",
     *     name="chemistry_category_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/ChemistryCategory/edit.html.twig")
     */
    public function addAction()
    {
        $chemistry_category = new ChemistryCategory();

        $form = $this->createForm(
            ChemistryCategoryType::class,
            $chemistry_category,
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
     *     name="chemistry_category_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/ChemistryCategory/edit.html.twig")
     * @param ChemistryCategory $chemistry_category
     * @return array
     */
    public function editAction(ChemistryCategory $chemistry_category)
    {
        return [
            'form' => $this->createForm(ChemistryCategoryType::class, $chemistry_category)->createView(),
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="chemistry_category_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/ChemistryCategory/edit.html.twig")
     * @param Request $request
     * @param ChemistryCategory $chemistry_category
     * @return array
     */
    public function updateAction(Request $request, ChemistryCategory $chemistry_category = null)
    {
        if (!$chemistry_category) {
            $chemistry_category = new ChemistryCategory();
        }

        $form = $this->createForm(ChemistryCategoryType::class, $chemistry_category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chemistry_category);
            $em->flush();
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="chemistry_category_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param ChemistryCategory $chemistry_category
     * @return RedirectResponse
     */
    public function deleteAction(ChemistryCategory $chemistry_category)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($chemistry_category);
        $em->flush();

        return $this->redirect($this->generateUrl('chemistry_category'));
    }
}
