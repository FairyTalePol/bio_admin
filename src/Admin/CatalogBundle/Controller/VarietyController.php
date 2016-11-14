<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Variety;
use Admin\CatalogBundle\Form\VarietyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Variety controller.
 *
 * @Route("/admin/catalog/variety")
 */
class VarietyController extends DefaultController
{
    /**
     * @Route("/", name="variety")
     * @Method({"GET"})
     * @Template()
     */
    public function indexAction()
    {
        $varieties = $this->getVarietyRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'varieties' => $varieties
        ];
    }

    /**
     * @Route("/add", name="variety_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:Variety:edit.html.twig")
     */
    public function addAction()
    {
        $variety = new Variety();

        $form = $this->createForm(new VarietyType(), $variety, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="variety_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param Variety $variety
     * @return array
     */
    public function editAction(Variety $variety)
    {
        return [
            'form' => $this->createForm(new VarietyType(), $variety)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="variety_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:Variety:edit.html.twig")
     * @param Request $request
     * @param Variety $variety
     * @return array
     */
    public function updateAction(Request $request, Variety $variety = null)
    {
        if (!$variety) {
            $variety = new Variety();
        }

        $form = $this->createForm(new VarietyType(), $variety);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($variety);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/delete/{id}", name="variety_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param Variety $variety
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Variety $variety)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($variety);
        $em->flush();

        return $this->redirect($this->generateUrl('variety'));
    }
}
