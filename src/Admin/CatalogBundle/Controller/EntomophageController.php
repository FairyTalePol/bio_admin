<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Entomophage;
use Admin\CatalogBundle\Form\EntomophageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vermin controller.
 *
 * @Route("/admin/catalog/entomophage")
 */
class EntomophageController extends DefaultController
{
    /**
     * @Route("/", name="entomophage")
     * @Method({"GET"})
     * @Template()
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
     * @Route("/add", name="entomophage_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:Entomophage:edit.html.twig")
     */
    public function addAction()
    {
        $entomophage = new Entomophage();

        $form = $this->createForm(new EntomophageType(), $entomophage, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="entomophage_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param Entomophage $entomophage
     * @return array
     */
    public function editAction(Entomophage $entomophage)
    {
        return [
            'form' => $this->createForm(new EntomophageType(), $entomophage)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="entomophage_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:Entomophage:edit.html.twig")
     * @param Request $request
     * @param Entomophage $entomophage
     * @return array
     */
    public function updateAction(Request $request, Entomophage $entomophage = null)
    {
        if (!$entomophage) {
            $entomophage = new Entomophage();
        }

        $form = $this->createForm(new EntomophageType(), $entomophage);

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
     * @Route("/delete/{id}", name="entomophage_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param Entomophage $entomophage
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Entomophage $entomophage)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($entomophage);
        $em->flush();

        return $this->redirect($this->generateUrl('entomophage'));
    }
}
