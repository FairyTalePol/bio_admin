<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Vermin;
use Admin\CatalogBundle\Form\VerminType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vermin controller.
 *
 * @Route("/admin/catalog/vermin")
 */
class VerminController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="vermin",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/Vermin/index.html.twig")
     */
    public function indexAction()
    {
        $vermins = $this->getVerminRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'vermins' => $vermins
        ];
    }

    /**
     * @Route(
     *     path="/add",
     *     name="vermin_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Vermin/edit.html.twig")
     */
    public function addAction()
    {
        $vermin = new Vermin();

        $form = $this->createForm(VerminType::class, $vermin, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="vermin_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Vermin/edit.html.twig")
     * @param Vermin $vermin
     * @return array
     */
    public function editAction(Vermin $vermin)
    {
        return [
            'form' => $this->createForm(VerminType::class, $vermin)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="vermin_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/Vermin/edit.html.twig")
     * @param Request $request
     * @param Vermin $vermin
     * @return array
     */
    public function updateAction(Request $request, Vermin $vermin = null)
    {
        if (!$vermin) {
            $vermin = new Vermin();
        }

        $form = $this->createForm(VerminType::class, $vermin);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vermin);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="vermin_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param Vermin $vermin
     * @return RedirectResponse
     */
    public function deleteAction(Vermin $vermin)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($vermin);
        $em->flush();

        return $this->redirect($this->generateUrl('vermin'));
    }
}
