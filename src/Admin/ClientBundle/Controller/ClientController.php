<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/24/14
 * Time: 4:31 PM
 */

namespace Admin\ClientBundle\Controller;

use Admin\ClientBundle\Entity\Client;
use Admin\ClientBundle\Form\ClientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auth controller.
 *
 * @Route("/admin/client")
 */
class ClientController extends DefaultController
{
  /**
   * @Route("/", name="client")
   * @Method({"GET"})
   * @Template()
   */
  public function indexAction()
  {
    $clients = $this->getClientRepository()
      ->createQueryBuilder('c')
      ->orderBy('c.email', 'ASC')
      ->getQuery()
      ->getResult();

    return [
      'clients' => $clients
    ];
  }

    /**
     * @Route("/delete/{id}", name="client_delete")
     * @Method({"GET", "POST", "DELETE"})
     * @ParamConverter("client", class="AdminClientBundle:Client")
     * @param Client $client
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
  public function deleteAction(Client $client)
  {
    $em = $this->getDoctrine()->getManager();

    $em->remove($client);
    $em->flush();

    return $this->redirect($this->generateUrl('client'));
  }

  /**
   * @Route("/add", name="client_add")
   * @Method({"GET", "POST"})
   * @Template("AdminClientBundle:Client:edit.html.twig")
   */
  public function addAction()
  {
    $client = new Client();

    $form = $this->createForm(new ClientType(), $client, [
      'error_bubbling' => true
    ]);

    return [
      'form' => $form->createView()
    ];
  }

    /**
     * @Route("/edit/{id}", name="client_edit")
     * @ParamConverter("client", class="AdminClientBundle:Client")
     * @Method({"GET", "POST"})
     * @Template()
     * @param Client $client
     * @return array
     */
  public function editAction(Client $client)
  {
    return [
      'form' => $this->createForm(new ClientType(), $client)->createView()
    ];
  }

    /**
     * @Route("/update/{id}", defaults={"id" = null}, name="client_update")
     * @ParamConverter("client", class="AdminClientBundle:Client")
     * @Method({"POST"})
     * @Template("AdminClientBundle:Client:edit.html.twig")
     * @param Request $request
     * @param Client $client
     * @return array
     */
  public function updateAction(Request $request, Client $client = null)
  {
    if (!$client) {
      $client = new Client();
      $client->setRegIp($request->getClientIp());
      $client->setRegDtm(new \DateTime());
    }

    $form = $this->createForm(new ClientType(), $client);

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
      'form' => $form->createView()
    ];
  }
} 