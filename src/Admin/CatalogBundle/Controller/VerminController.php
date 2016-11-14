<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Vermin;
use Admin\CatalogBundle\Form\VerminType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vermin controller.
 *
 * @Route("/admin/catalog/vermin")
 */
class VerminController extends DefaultController
{
    /**
     * @Route("/", name="vermin")
     * @Method({"GET"})
     * @Template()
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
     * @Route("/add", name="vermin_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:Vermin:edit.html.twig")
     */
    public function addAction()
    {
        $vermin = new Vermin();

        $form = $this->createForm(new VerminType(), $vermin, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="vermin_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param Vermin $vermin
     * @return array
     */
    public function editAction(Vermin $vermin)
    {
        return [
            'form' => $this->createForm(new VerminType(), $vermin)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="vermin_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:Vermin:edit.html.twig")
     * @param Request $request
     * @param Vermin $vermin
     * @return array
     */
    public function updateAction(Request $request, Vermin $vermin = null)
    {
        if (!$vermin) {
            $vermin = new Vermin();
        }

        $form = $this->createForm(new VerminType(), $vermin);

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
     * @Route("/delete/{id}", name="vermin_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param Vermin $vermin
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Vermin $vermin)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($vermin);
        $em->flush();

        return $this->redirect($this->generateUrl('vermin'));
    }
}
