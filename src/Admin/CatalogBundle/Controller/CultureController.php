<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Culture;
use Admin\CatalogBundle\Form\CultureType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Culture API controller.
 *
 * @Route("/admin/catalog/culture")
 */
class CultureController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="culture",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/Culture/index.html.twig")
     */
    public function indexAction()
    {
        $cultures = $this->getCultureRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'cultures' => $cultures
        ];
    }

    /**
     * @Route(
     *     path="/add",
     *     name="culture_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Culture/edit.html.twig")
     */
    public function addAction()
    {
        $culture = new Culture();

        $form = $this->createForm(CultureType::class, $culture, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="culture_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Culture/edit.html.twig")
     * @param Culture $culture
     * @return array
     */
    public function editAction(Culture $culture)
    {
        return [
            'form' => $this->createForm(CultureType::class, $culture)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="culture_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/Culture/edit.html.twig")
     * @param Request $request
     * @param Culture $culture
     * @return array
     */
    public function updateAction(Request $request, Culture $culture = null)
    {
        if (!$culture) {
            $culture = new Culture();
        }

        $form = $this->createForm(CultureType::class, $culture);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($culture);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="culture_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param Culture $culture
     * @return RedirectResponse
     */
    public function deleteAction(Culture $culture)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($culture);
        $em->flush();

        return $this->redirect($this->generateUrl('culture'));
    }
}
