<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Culture;
use Admin\CatalogBundle\Form\CultureType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Culture API controller.
 *
 * @Route("/admin/catalog/culture")
 */
class CultureController extends DefaultController
{
    /**
     * @Route("/", name="culture")
     * @Method({"GET"})
     * @Template()
     */
    public function indexAction()
    {
        $cultures = $this->getCultureRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'cultures' => $cultures
        ];
    }

    /**
     * @Route("/add", name="culture_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:Culture:edit.html.twig")
     */
    public function addAction()
    {
        $culture = new Culture();

        $form = $this->createForm(new CultureType(), $culture, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="culture_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param Culture $culture
     * @return array
     */
    public function editAction(Culture $culture)
    {
        return [
            'form' => $this->createForm(new CultureType(), $culture)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="culture_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:Culture:edit.html.twig")
     * @param Request $request
     * @param Culture $culture
     * @return array
     */
    public function updateAction(Request $request, Culture $culture = null)
    {
        if (!$culture) {
            $culture = new Culture();
        }

        $form = $this->createForm(new CultureType(), $culture);

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
     * @Route("/delete/{id}", name="culture_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param Culture $culture
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Culture $culture)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($culture);
        $em->flush();

        return $this->redirect($this->generateUrl('culture'));
    }
}
