<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Provider;
use Admin\CatalogBundle\Form\ProviderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Provider API controller.
 *
 * @Route("/admin/catalog/provider")
 */
class ProviderController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="provider",
     *     methods={"GET"}
     * )
     * @Template("@AdminCatalog/Provider/index.html.twig")
     */
    public function indexAction()
    {
        $providers = $this->getProviderRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.fio', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'providers' => $providers
        ];
    }

    /**
     * @Route(
     *     path="/add",
     *     name="provider_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Provider/edit.html.twig")
     */
    public function addAction()
    {
        $provider = new Provider();

        $form = $this->createForm(ProviderType::class, $provider, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="provider_edit",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminCatalog/Provider/edit.html.twig")
     * @param Provider $provider
     * @return array
     */
    public function editAction(Provider $provider)
    {
        return [
            'form' => $this->createForm(ProviderType::class, $provider)->createView()
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="provider_update",
     *     methods={"POST"}
     * )
     * @Template("@AdminCatalog/Provider/edit.html.twig")
     * @param Request $request
     * @param Provider $provider
     * @return array
     */
    public function updateAction(Request $request, Provider $provider = null)
    {
        if (!$provider) {
            $provider = new Provider();
        }

        $form = $this->createForm(ProviderType::class, $provider);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($provider);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="provider_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @param Provider $provider
     * @return RedirectResponse
     */
    public function deleteAction(Provider $provider)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($provider);
        $em->flush();

        return $this->redirect($this->generateUrl('provider'));
    }
}
