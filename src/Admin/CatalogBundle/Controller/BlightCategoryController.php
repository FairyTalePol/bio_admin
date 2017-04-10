<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\BlightCategory;
use Admin\CatalogBundle\Form\BlightCategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * BlightCategory API controller.
 *
 * @Route("/admin/catalog/blight-category")
 */
class BlightCategoryController extends DefaultController
{
    /**
     * @Route("/", name="blight_category")
     * @Method({"GET"})
     * @Template()
     */
    public function indexAction()
    {
        $blight_categories = $this->getBlightCategoryRepository()
            ->createQueryBuilder('b')
            ->orderBy('b.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'blight_categories' => $blight_categories
        ];
    }

    /**
     * @Route("/add", name="blight_category_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:BlightCategory:edit.html.twig")
     */
    public function addAction()
    {
        $blight_category = new BlightCategory();

        $form = $this->createForm(new BlightCategoryType(), $blight_category, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="blight_category_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param BlightCategory $blight_category
     * @return array
     */
    public function editAction(BlightCategory $blight_category)
    {
        return [
            'form' => $this->createForm(new BlightCategoryType(), $blight_category)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="blight_category_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:BlightCategory:edit.html.twig")
     * @param Request $request
     * @param BlightCategory $blight_category
     * @return array
     */
    public function updateAction(Request $request, BlightCategory $blight_category = null)
    {
        if (!$blight_category) {
            $blight_category = new BlightCategory();
        }

        $form = $this->createForm(new BlightCategoryType(), $blight_category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blight_category);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/delete/{id}", name="blight_category_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param BlightCategory $blight_category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(BlightCategory $blight_category)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($blight_category);
        $em->flush();

        return $this->redirect($this->generateUrl('blight_category'));
    }
}
