<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\ChemistryCategory;
use Admin\CatalogBundle\Form\ChemistryCategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * ChemistryCategory API controller.
 *
 * @Route("/admin/catalog/chemistry-category")
 */
class ChemistryCategoryController extends DefaultController
{
    /**
     * @Route("/", name="chemistry_category")
     * @Method({"GET"})
     * @Template()
     */
    public function indexAction()
    {
        $chemistry_categories = $this->getChemistryCategoryRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'chemistry_categories' => $chemistry_categories
        ];
    }

    /**
     * @Route("/add", name="chemistry_category_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:ChemistryCategory:edit.html.twig")
     */
    public function addAction()
    {
        $chemistry_category = new ChemistryCategory();

        $form = $this->createForm(new ChemistryCategoryType(), $chemistry_category, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="chemistry_category_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param ChemistryCategory $chemistry_category
     * @return array
     */
    public function editAction(ChemistryCategory $chemistry_category)
    {
        return [
            'form' => $this->createForm(new ChemistryCategoryType(), $chemistry_category)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="chemistry_category_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:ChemistryCategory:edit.html.twig")
     * @param Request $request
     * @param ChemistryCategory $chemistry_category
     * @return array
     */
    public function updateAction(Request $request, ChemistryCategory $chemistry_category = null)
    {
        if (!$chemistry_category) {
            $chemistry_category = new ChemistryCategory();
        }

        $form = $this->createForm(new ChemistryCategoryType(), $chemistry_category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chemistry_category);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/delete/{id}", name="chemistry_category_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param ChemistryCategory $chemistry_category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(ChemistryCategory $chemistry_category)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($chemistry_category);
        $em->flush();

        return $this->redirect($this->generateUrl('chemistry_category'));
    }
}
