<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Manufacturer;
use Admin\CatalogBundle\Form\ManufacturerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Manufacturer API controller.
 *
 * @Route("/admin/catalog/manufacturer")
 */
class ManufacturerController extends DefaultController
{
    /**
     * @Route("/", name="manufacturer")
     * @Method({"GET"})
     * @Template()
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
     * @Route("/add", name="manufacturer_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:Manufacturer:edit.html.twig")
     */
    public function addAction()
    {
        $manufacturer = new Manufacturer();

        $form = $this->createForm(new ManufacturerType(), $manufacturer, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="manufacturer_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param Manufacturer $manufacturer
     * @return array
     */
    public function editAction(Manufacturer $manufacturer)
    {
        return [
            'form' => $this->createForm(new ManufacturerType(), $manufacturer)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="manufacturer_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:Manufacturer:edit.html.twig")
     * @param Request $request
     * @param Manufacturer $manufacturer
     * @return array
     */
    public function updateAction(Request $request, Manufacturer $manufacturer = null)
    {
        if (!$manufacturer) {
            $manufacturer = new Manufacturer();
        }

        $form = $this->createForm(new ManufacturerType(), $manufacturer);

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
     * @Route("/delete/{id}", name="manufacturer_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param Manufacturer $manufacturer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Manufacturer $manufacturer)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($manufacturer);
        $em->flush();

        return $this->redirect($this->generateUrl('manufacturer'));
    }
}
