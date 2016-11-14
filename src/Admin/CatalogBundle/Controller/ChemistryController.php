<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Chemistry;
use Admin\CatalogBundle\Form\ChemistryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Chemistry API controller.
 *
 * @Route("/admin/catalog/chemistry")
 */
class ChemistryController extends DefaultController
{
    /**
     * @Route("/", name="chemistry")
     * @Method({"GET"})
     * @Template()
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
     * @Route("/add", name="chemistry_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:Chemistry:edit.html.twig")
     */
    public function addAction()
    {
        $chemistry = new Chemistry();

        $form = $this->createForm(new ChemistryType(), $chemistry, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="chemistry_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param Chemistry $chemistry
     * @return array
     */
    public function editAction(Chemistry $chemistry)
    {
        return [
            'form' => $this->createForm(new ChemistryType(), $chemistry)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="chemistry_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:Chemistry:edit.html.twig")
     * @param Request $request
     * @param Chemistry $chemistry
     * @return array
     */
    public function updateAction(Request $request, Chemistry $chemistry = null)
    {
        if (!$chemistry) {
            $chemistry = new Chemistry();
        }

        $form = $this->createForm(new ChemistryType(), $chemistry);

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
     * @Route("/delete/{id}", name="chemistry_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param Chemistry $chemistry
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Chemistry $chemistry)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($chemistry);
        $em->flush();

        return $this->redirect($this->generateUrl('chemistry'));
    }

}
