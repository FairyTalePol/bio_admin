<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\EntomophageCategory;
use Admin\CatalogBundle\Form\EntomophageCategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * EntomophageCategory API controller.
 *
 * @Route("/admin/catalog/entomophage-category")
 */
class EntomophageCategoryController extends DefaultController
{
    /**
     * @Route("/", name="entomophage_category")
     * @Method({"GET"})
     * @Template()
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
     * @Route("/add", name="entomophage_category_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:EntomophageCategory:edit.html.twig")
     */
    public function addAction()
    {
        $entomophage_category = new EntomophageCategory();

        $form = $this->createForm(new EntomophageCategoryType(), $entomophage_category, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="entomophage_category_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param EntomophageCategory $entomophage_category
     * @return array
     */
    public function editAction(EntomophageCategory $entomophage_category)
    {
        return [
            'form' => $this->createForm(new EntomophageCategoryType(), $entomophage_category)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="entomophage_category_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:EntomophageCategory:edit.html.twig")
     * @param Request $request
     * @param EntomophageCategory $entomophage_category
     * @return array
     */
    public function updateAction(Request $request, EntomophageCategory $entomophage_category = null)
    {
        if (!$entomophage_category) {
            $entomophage_category = new EntomophageCategory();
        }

        $form = $this->createForm(new EntomophageCategoryType(), $entomophage_category);

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
     * @Route("/delete/{id}", name="entomophage_category_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param EntomophageCategory $entomophage_category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(EntomophageCategory $entomophage_category)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($entomophage_category);
        $em->flush();

        return $this->redirect($this->generateUrl('entomophage_category'));
    }
}
