<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Substrate;
use Admin\CatalogBundle\Form\SubstrateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Substrate API controller.
 *
 * @Route("/admin/catalog/substrate")
 */
class SubstrateController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="substrate",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/Substrate/index.html.twig")
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
     * @Route(
     *     path="/add",
     *     name="substrate_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Substrate/edit.html.twig")
     */
    public function addAction()
    {
        $substrate = new Substrate();

        $form = $this->createForm(SubstrateType::class, $substrate, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="substrate_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Substrate/edit.html.twig")
     * @param Substrate $substrate
     * @return array
     */
    public function editAction(Substrate $substrate)
    {
        return [
            'form' => $this->createForm(SubstrateType::class, $substrate)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="substrate_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/Substrate/edit.html.twig")
     * @param Request $request
     * @param Substrate $substrate
     * @return array
     */
    public function updateAction(Request $request, Substrate $substrate = null)
    {
        if (!$substrate) {
            $substrate = new Substrate();
        }

        $form = $this->createForm(SubstrateType::class, $substrate);

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
     * @Route(
     *     path="/delete/{id}",
     *     name="substrate_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param Substrate $substrate
     * @return RedirectResponse
     */
    public function deleteAction(Substrate $substrate)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($substrate);
        $em->flush();

        return $this->redirect($this->generateUrl('substrate'));
    }
}
