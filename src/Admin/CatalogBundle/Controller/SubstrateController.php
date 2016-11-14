<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Substrate;
use Admin\CatalogBundle\Form\SubstrateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Substrate API controller.
 *
 * @Route("/admin/catalog/substrate")
 */
class SubstrateController extends DefaultController
{
    /**
     * @Route("/", name="substrate")
     * @Method({"GET"})
     * @Template()
     */
    public function indexAction()
    {
        $substrates = $this->getSubstrateRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'substrates' => $substrates
        ];
    }

    /**
     * @Route("/add", name="substrate_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:Substrate:edit.html.twig")
     */
    public function addAction()
    {
        $substrate = new Substrate();

        $form = $this->createForm(new SubstrateType(), $substrate, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="substrate_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param Substrate $substrate
     * @return array
     */
    public function editAction(Substrate $substrate)
    {
        return [
            'form' => $this->createForm(new SubstrateType(), $substrate)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="substrate_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:Substrate:edit.html.twig")
     * @param Request $request
     * @param Substrate $substrate
     * @return array
     */
    public function updateAction(Request $request, Substrate $substrate = null)
    {
        if (!$substrate) {
            $substrate = new Substrate();
        }

        $form = $this->createForm(new SubstrateType(), $substrate);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($substrate);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/delete/{id}", name="substrate_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param Substrate $substrate
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Substrate $substrate)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($substrate);
        $em->flush();

        return $this->redirect($this->generateUrl('substrate'));
    }
}
