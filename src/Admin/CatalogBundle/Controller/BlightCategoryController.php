<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\BlightCategory;
use Admin\CatalogBundle\Form\BlightCategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * BlightCategory API controller.
 *
 * @Route("/admin/catalog/blight-category")
 */
class BlightCategoryController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="blight_category",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/BlightCategory/index.html.twig")
     */
    public function indexAction()
    {
        $blight_categories = $this->getBlightCategoryRepository()
            ->createQueryBuilder('b')
            ->orderBy('b.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'blight_categories' => $blight_categories,
        ];
    }

    /**
     * @Route(
     *     path="/add",
     *     name="blight_category_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/BlightCategory/edit.html.twig")
     */
    public function addAction()
    {
        $blight_category = new BlightCategory();

        $form = $this->createForm(
            BlightCategoryType::class,
            $blight_category,
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
     *     name="blight_category_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/BlightCategory/edit.html.twig")
     * @param BlightCategory $blight_category
     * @return array
     */
    public function editAction(BlightCategory $blight_category)
    {
        return [
            'form' => $this->createForm(BlightCategoryType::class, $blight_category)->createView(),
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="blight_category_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/BlightCategory/edit.html.twig")
     * @param Request $request
     * @param BlightCategory $blight_category
     * @return array
     */
    public function updateAction(Request $request, BlightCategory $blight_category = null)
    {
        if (!$blight_category) {
            $blight_category = new BlightCategory();
        }

        $form = $this->createForm(BlightCategoryType::class, $blight_category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blight_category);
            $em->flush();
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="blight_category_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param BlightCategory $blight_category
     * @return RedirectResponse
     */
    public function deleteAction(BlightCategory $blight_category)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($blight_category);
        $em->flush();

        return $this->redirect($this->generateUrl('blight_category'));
    }
}
