<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\SubstrateCategoryManufacturer;
use Admin\CatalogBundle\Form\SubstrateCategoryManufacturerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * SubstrateCategoryManufacturer API controller.
 *
 * @Route("/admin/catalog/substrate-manufacturer")
 */
class SubstrateCategoryManufacturerController extends DefaultController
{
    /**
     * @Route("/", name="substrate_manufacturer")
     * @Method({"GET"})
     * @Template()
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
     * @Route("/add", name="substrate_manufacturer_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:SubstrateCategoryManufacturer:edit.html.twig")
     */
    public function addAction()
    {
        $substrate_manufacturer = new SubstrateCategoryManufacturer();

        $form = $this->createForm(new SubstrateCategoryManufacturerType(), $substrate_manufacturer, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="substrate_manufacturer_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param SubstrateCategoryManufacturer $substrate_manufacturer
     * @return array
     */
    public function editAction(SubstrateCategoryManufacturer $substrate_manufacturer)
    {
        return [
            'form' => $this->createForm(new SubstrateCategoryManufacturerType(), $substrate_manufacturer)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="substrate_manufacturer_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:SubstrateCategoryManufacturer:edit.html.twig")
     * @param Request $request
     * @param SubstrateCategoryManufacturer $substrate_manufacturer
     * @return array
     */
    public function updateAction(Request $request, SubstrateCategoryManufacturer $substrate_manufacturer = null)
    {
        if (!$substrate_manufacturer) {
            $substrate_manufacturer = new SubstrateCategoryManufacturer();
        }

        $form = $this->createForm(new SubstrateCategoryManufacturerType(), $substrate_manufacturer);

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
     * @Route("/delete/{id}", name="substrate_manufacturer_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param SubstrateCategoryManufacturer $substrate_manufacturer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(SubstrateCategoryManufacturer $substrate_manufacturer)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($substrate_manufacturer);
        $em->flush();

        return $this->redirect($this->generateUrl('substrate_manufacturer'));
    }
}
