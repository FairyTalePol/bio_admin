<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Manufacturer;
use Admin\CatalogBundle\Form\ManufacturerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Manufacturer API controller.
 *
 * @Route("/admin/catalog/manufacturer")
 */
class ManufacturerController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="manufacturer",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/Manufacturer/index.html.twig")
     */
    public function indexAction()
    {
        $manufacturers = $this->getManufacturerRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'manufacturers' => $manufacturers
        ];
    }

    /**
     * @Route(
     *     path="/add",
     *     name="manufacturer_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Manufacturer/edit.html.twig")
     */
    public function addAction()
    {
        $manufacturer = new Manufacturer();

        $form = $this->createForm(ManufacturerType::class, $manufacturer, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="manufacturer_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Manufacturer/edit.html.twig")
     * @param Manufacturer $manufacturer
     * @return array
     */
    public function editAction(Manufacturer $manufacturer)
    {
        return [
            'form' => $this->createForm(ManufacturerType::class, $manufacturer)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="manufacturer_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/Manufacturer/edit.html.twig")
     * @param Request $request
     * @param Manufacturer $manufacturer
     * @return array
     */
    public function updateAction(Request $request, Manufacturer $manufacturer = null)
    {
        if (!$manufacturer) {
            $manufacturer = new Manufacturer();
        }

        $form = $this->createForm(ManufacturerType::class, $manufacturer);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($manufacturer);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="manufacturer_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param Manufacturer $manufacturer
     * @return RedirectResponse
     */
    public function deleteAction(Manufacturer $manufacturer)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($manufacturer);
        $em->flush();

        return $this->redirect($this->generateUrl('manufacturer'));
    }
}
