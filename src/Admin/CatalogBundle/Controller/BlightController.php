<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Blight;
use Admin\CatalogBundle\Form\BlightType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Blight controller.
 *
 * @Route("/admin/catalog/blight")
 */
class BlightController extends DefaultController
{
    /**
     * @Route("/", name="blight")
     * @Method({"GET"})
     * @Template()
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
     * @Route("/add", name="blight_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:Blight:edit.html.twig")
     */
    public function addAction()
    {
        $blight = new Blight();

        $form = $this->createForm(new BlightType(), $blight, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="blight_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param Blight $blight
     * @return array
     */
    public function editAction(Blight $blight)
    {
        return [
            'form' => $this->createForm(new BlightType(), $blight)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="blight_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:Blight:edit.html.twig")
     * @param Request $request
     * @param Blight $blight
     * @return array
     */
    public function updateAction(Request $request, Blight $blight = null)
    {
        if (!$blight) {
            $blight = new Blight();
        }

        $form = $this->createForm(new BlightType(), $blight);

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
     * @Route("/delete/{id}", name="blight_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param Blight $blight
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Blight $blight)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($blight);
        $em->flush();

        return $this->redirect($this->generateUrl('blight'));
    }
}
