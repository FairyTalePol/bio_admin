<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Chemistry;
use Admin\CatalogBundle\Form\ChemistryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Chemistry API controller.
 *
 * @Route("/admin/catalog/chemistry")
 */
class ChemistryController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="chemistry",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/Chemistry/index.html.twig")
     */
    public function indexAction()
    {
        $chemistry = $this->getChemistryRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            '_chemistry' => $chemistry
        ];
    }

    /**
     * @Route(
     *     path="/add",
     *     name="chemistry_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Chemistry/edit.html.twig")
     */
    public function addAction()
    {
        $chemistry = new Chemistry();

        $form = $this->createForm(ChemistryType::class, $chemistry, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="chemistry_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Chemistry/edit.html.twig")
     * @param Chemistry $chemistry
     * @return array
     */
    public function editAction(Chemistry $chemistry)
    {
        return [
            'form' => $this->createForm(ChemistryType::class, $chemistry)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="chemistry_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/Chemistry/edit.html.twig")
     * @param Request $request
     * @param Chemistry $chemistry
     * @return array
     */
    public function updateAction(Request $request, Chemistry $chemistry = null)
    {
        if (!$chemistry) {
            $chemistry = new Chemistry();
        }

        $form = $this->createForm(ChemistryType::class, $chemistry);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chemistry);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="chemistry_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param Chemistry $chemistry
     * @return RedirectResponse
     */
    public function deleteAction(Chemistry $chemistry)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($chemistry);
        $em->flush();

        return $this->redirect($this->generateUrl('chemistry'));
    }

}
