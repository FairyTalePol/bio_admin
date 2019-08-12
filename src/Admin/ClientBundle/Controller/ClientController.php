<?php

namespace Admin\ClientBundle\Controller;

use Admin\ClientBundle\Entity\Client;
use Admin\ClientBundle\Form\ClientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auth controller.
 *
 * @Route("/admin/client")
 */
class ClientController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="client",
     *     methods={"GET"}
     * )
     * @Template("@AdminClient/Client/index.html.twig")
     */
    public function indexAction()
    {
        $clients = $this->getClientRepository()
            ->createQueryBuilder('c')
            ->orderBy('c.email', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'clients' => $clients,
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="client_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @ParamConverter("client", class="AdminClientBundle:Client")
     * @param Client $client
     * @return RedirectResponse
     */
    public function deleteAction(Client $client)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($client);
        $em->flush();

        return $this->redirect($this->generateUrl('client'));
    }

    /**
     * @Route(
     *     path="/add",
     *     name="client_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminClient/Client/edit.html.twig")
     */
    public function addAction()
    {
        $client = new Client();

        $form = $this->createForm(ClientType::class, $client, [
                'error_bubbling' => true,
            ]
        );

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="client_edit",
     *     methods={"GET", "POST"}
     * )
     * @ParamConverter("client", class="AdminClientBundle:Client")
     * @Template("@AdminClient/Client/edit.html.twig")
     * @param Request $request
     * @param Client $client
     * @return array
     */
    public function editAction(Request $request, Client $client)
    {
        return [
            'form' => $this->createForm(ClientType::class, $client)->createView(),
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="client_update",
     *     methods={"POST"}
     * )
     * @ParamConverter("client", class="AdminClientBundle:Client")
     * @Template("@AdminClient/Client/edit.html.twig")
     * @param Request $request
     * @param Client|null $client
     * @return array
     * @throws \Exception
     */
    public function updateAction(Request $request, Client $client = null)
    {
        if (!$client) {
            $client = new Client();
            $client->setRegIp($request->getClientIp());
            $client->setRegDtm(new \DateTime());
        }

        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if ($client->getId()) {
                $em->merge($client);
            } else {
                $em->persist($client);
            }

            $em->flush();
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
