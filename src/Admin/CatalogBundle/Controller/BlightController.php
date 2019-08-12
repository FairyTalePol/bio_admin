<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Blight;
use Admin\CatalogBundle\Form\BlightType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Blight controller.
 *
 * @Route("/admin/catalog/blight")
 */
class BlightController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="blight",
     *     methods={"GET"}
     * )
     * @Route("/", name="blight")
     * @Template("@AdminCatalog/Blight/index.html.twig")
     */
    public function indexAction()
    {
        $blights = $this->getBlightRepository()
            ->createQueryBuilder('b')
            ->orderBy('b.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'blights' => $blights
        ];
    }

    /**
     * @Route(
     *     path="/add",
     *     name="blight_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Blight/edit.html.twig")
     */
    public function addAction()
    {
        $blight = new Blight();

        $form = $this->createForm(BlightType::class, $blight, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="blight_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Blight/edit.html.twig")
     * @param Blight $blight
     * @return array
     */
    public function editAction(Blight $blight)
    {
        return [
            'form' => $this->createForm(BlightType::class, $blight)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="blight_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/Blight/edit.html.twig")
     * @param Request $request
     * @param Blight $blight
     * @return array
     */
    public function updateAction(Request $request, Blight $blight = null)
    {
        if (!$blight) {
            $blight = new Blight();
        }

        $form = $this->createForm(BlightType::class, $blight);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blight);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="blight_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param Blight $blight
     * @return RedirectResponse
     */
    public function deleteAction(Blight $blight)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($blight);
        $em->flush();

        return $this->redirect($this->generateUrl('blight'));
    }
}
