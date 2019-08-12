<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\SubstrateCategoryManufacturer;
use Admin\CatalogBundle\Form\SubstrateCategoryManufacturerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * SubstrateCategoryManufacturer API controller.
 *
 * @Route("/admin/catalog/substrate-manufacturer")
 */
class SubstrateCategoryManufacturerController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="substrate_manufacturer",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/SubstrateCategoryManufacturer/index.html.twig")
     */
    public function indexAction()
    {
        $substrates = $this->getSubstrateCategoryManufacturerRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'substrate_categories' => $substrates
        ];
    }

    /**
     * @Route(
     *     path="/add",
     *     name="substrate_manufacturer_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/SubstrateCategoryManufacturer/edit.html.twig")
     */
    public function addAction()
    {
        $substrate_manufacturer = new SubstrateCategoryManufacturer();

        $form = $this->createForm(SubstrateCategoryManufacturerType::class, $substrate_manufacturer, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="substrate_manufacturer_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/SubstrateCategoryManufacturer/edit.html.twig")
     * @param SubstrateCategoryManufacturer $substrate_manufacturer
     * @return array
     */
    public function editAction(SubstrateCategoryManufacturer $substrate_manufacturer)
    {
        return [
            'form' => $this->createForm(SubstrateCategoryManufacturerType::class, $substrate_manufacturer)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="substrate_manufacturer_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/SubstrateCategoryManufacturer/edit.html.twig")
     * @param Request $request
     * @param SubstrateCategoryManufacturer $substrate_manufacturer
     * @return array
     */
    public function updateAction(Request $request, SubstrateCategoryManufacturer $substrate_manufacturer = null)
    {
        if (!$substrate_manufacturer) {
            $substrate_manufacturer = new SubstrateCategoryManufacturer();
        }

        $form = $this->createForm(SubstrateCategoryManufacturerType::class, $substrate_manufacturer);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($substrate_manufacturer);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="substrate_manufacturer_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param SubstrateCategoryManufacturer $substrate_manufacturer
     * @return RedirectResponse
     */
    public function deleteAction(SubstrateCategoryManufacturer $substrate_manufacturer)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($substrate_manufacturer);
        $em->flush();

        return $this->redirect($this->generateUrl('substrate_manufacturer'));
    }
}
