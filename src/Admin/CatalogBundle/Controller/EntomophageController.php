<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Entomophage;
use Admin\CatalogBundle\Form\EntomophageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vermin controller.
 *
 * @Route("/admin/catalog/entomophage")
 */
class EntomophageController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="entomophage",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/Entomophage/index.html.twig")
     */
    public function indexAction()
    {
        $entomophages = $this->getEntomophageRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'entomophages' => $entomophages
        ];
    }

    /**
     * @Route(
     *     path="/add",
     *     name="entomophage_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Entomophage/edit.html.twig")
     */
    public function addAction()
    {
        $entomophage = new Entomophage();

        $form = $this->createForm(EntomophageType::class, $entomophage, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="entomophage_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Entomophage/edit.html.twig")
     * @param Entomophage $entomophage
     * @return array
     */
    public function editAction(Entomophage $entomophage)
    {
        return [
            'form' => $this->createForm(EntomophageType::class, $entomophage)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="entomophage_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/Entomophage/edit.html.twig")
     * @param Request $request
     * @param Entomophage $entomophage
     * @return array
     */
    public function updateAction(Request $request, Entomophage $entomophage = null)
    {
        if (!$entomophage) {
            $entomophage = new Entomophage();
        }

        $form = $this->createForm(EntomophageType::class, $entomophage);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entomophage);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="entomophage_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param Entomophage $entomophage
     * @return RedirectResponse
     */
    public function deleteAction(Entomophage $entomophage)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($entomophage);
        $em->flush();

        return $this->redirect($this->generateUrl('entomophage'));
    }
}
