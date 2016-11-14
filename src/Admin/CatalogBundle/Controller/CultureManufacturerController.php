<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Manufacturer;
use Admin\CatalogBundle\Exception\ChildrenException;
use Doctrine\ORM\Query;
use Admin\CatalogBundle\Entity\CultureManufacturer;
use Admin\CatalogBundle\Form\CultureManufacturerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * CultureManufacturer API controller.
 *
 * @Route("/admin/catalog/culture-manufacturer")
 */
class CultureManufacturerController extends DefaultController
{
    /**
     * @Route("/", name="culture_manufacturer")
     * @Method({"GET"})
     * @Template()
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
     * @Route("/add", name="culture_manufacturer_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:CultureManufacturer:edit.html.twig")
     */
    public function addAction()
    {
        $culture = new CultureManufacturer();

        $form = $this->createForm(new CultureManufacturerType(), $culture, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="culture_manufacturer_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param CultureManufacturer $culture
     * @return array
     */
    public function editAction(CultureManufacturer $culture)
    {
        return [
            'form' => $this->createForm(new CultureManufacturerType(), $culture)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="culture_manufacturer_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:CultureManufacturer:edit.html.twig")
     * @param Request $request
     * @param CultureManufacturer $culture
     * @return array
     */
    public function updateAction(Request $request, CultureManufacturer $culture = null)
    {
        if (!$culture) {
            $culture = new CultureManufacturer();
        }

        $form = $this->createForm(new CultureManufacturerType(), $culture);

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
     * @Route("/delete/{id}", name="culture_manufacturer_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param CultureManufacturer $culture
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(CultureManufacturer $culture)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($culture);
        $em->flush();

        return $this->redirect($this->generateUrl('culture_manufacturer'));
    }
}
