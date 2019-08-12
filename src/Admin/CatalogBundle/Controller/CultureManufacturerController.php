<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\CultureManufacturer;
use Admin\CatalogBundle\Form\CultureManufacturerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * CultureManufacturer API controller.
 *
 * @Route("/admin/catalog/culture-manufacturer")
 */
class CultureManufacturerController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="culture_manufacturer",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/CultureManufacturer/index.html.twig")
     */
    public function indexAction()
    {
        $cultures = $this->getCultureManufacturerRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'cultures' => $cultures
        ];
    }

    /**
     * @Route(
     *     path="/add",
     *     name="culture_manufacturer_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/CultureManufacturer/edit.html.twig")
     */
    public function addAction()
    {
        $culture = new CultureManufacturer();

        $form = $this->createForm(CultureManufacturerType::class, $culture, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="culture_manufacturer_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/CultureManufacturer/edit.html.twig")
     * @param CultureManufacturer $culture
     * @return array
     */
    public function editAction(CultureManufacturer $culture)
    {
        return [
            'form' => $this->createForm(CultureManufacturerType::class, $culture)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="culture_manufacturer_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/CultureManufacturer/edit.html.twig")
     * @param Request $request
     * @param CultureManufacturer $culture
     * @return array
     */
    public function updateAction(Request $request, CultureManufacturer $culture = null)
    {
        if (!$culture) {
            $culture = new CultureManufacturer();
        }

        $form = $this->createForm(CultureManufacturerType::class, $culture);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($culture);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="culture_manufacturer_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param CultureManufacturer $culture
     * @return RedirectResponse
     */
    public function deleteAction(CultureManufacturer $culture)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($culture);
        $em->flush();

        return $this->redirect($this->generateUrl('culture_manufacturer'));
    }
}
