<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Variety;
use Admin\CatalogBundle\Form\VarietyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Variety controller.
 *
 * @Route("/admin/catalog/variety")
 */
class VarietyController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="variety",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/Variety/index.html.twig")
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
     * @Route(
     *     path="/add",
     *     name="variety_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Variety/edit.html.twig")
     */
    public function addAction()
    {
        $variety = new Variety();

        $form = $this->createForm(VarietyType::class, $variety, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="variety_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Variety/edit.html.twig")
     * @param Variety $variety
     * @return array
     */
    public function editAction(Variety $variety)
    {
        return [
            'form' => $this->createForm(VarietyType::class, $variety)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="variety_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/Variety/edit.html.twig")
     * @param Request $request
     * @param Variety $variety
     * @return array
     */
    public function updateAction(Request $request, Variety $variety = null)
    {
        if (!$variety) {
            $variety = new Variety();
        }

        $form = $this->createForm(VarietyType::class, $variety);

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
     * @Route(
     *     path="/delete/{id}",
     *     name="variety_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param Variety $variety
     * @return RedirectResponse
     */
    public function deleteAction(Variety $variety)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($variety);
        $em->flush();

        return $this->redirect($this->generateUrl('variety'));
    }
}
