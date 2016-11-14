<?php

namespace Admin\CatalogBundle\Controller;

use Admin\CatalogBundle\Entity\Provider;
use Admin\CatalogBundle\Form\ProviderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Provider API controller.
 *
 * @Route("/admin/catalog/provider")
 */
class ProviderController extends DefaultController
{
    /**
     * @Route("/", name="provider")
     * @Method({"GET"})
     * @Template()
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
     * @Route("/add", name="provider_add")
     * @Method({"GET", "POST"})
     * @Template("AdminCatalogBundle:Provider:edit.html.twig")
     */
    public function addAction()
    {
        $provider = new Provider();

        $form = $this->createForm(new ProviderType(), $provider, [
            'error_bubbling' => true
        ]);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="provider_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @param Provider $provider
     * @return array
     */
    public function editAction(Provider $provider)
    {
        return [
            'form' => $this->createForm(new ProviderType(), $provider)->createView()
        ];
    }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="provider_update")
     * @Method({"POST"})
     * @Template("AdminCatalogBundle:Provider:edit.html.twig")
     * @param Request $request
     * @param Provider $provider
     * @return array
     */
    public function updateAction(Request $request, Provider $provider = null)
    {
        if (!$provider) {
            $provider = new Provider();
        }

        $form = $this->createForm(new ProviderType(), $provider);

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
     * @Route("/delete/{id}", name="provider_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @param Provider $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Provider $provider)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($provider);
        $em->flush();

        return $this->redirect($this->generateUrl('provider'));
    }
}
