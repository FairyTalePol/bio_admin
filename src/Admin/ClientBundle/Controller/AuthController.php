<?php

namespace Admin\ClientBundle\Controller;

use Admin\ClientBundle\Entity\Client;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Auth controller.
 *
 * @Route("/")
 */
class AuthController extends DefaultController
{
    /**
     * @Route(
     *     path="/",
     *     name="auth"
     * )
     * @Template("@AdminClient/Auth/index.html.twig")
     * @param Request $request
     * @return array|RedirectResponse
     */
    public function indexAction(Request $request)
    {
        $error = null;

        if ($request->getMethod() == 'POST') {

            /** @var Client $client */
            $client = $this->getClientRepository()->findOneBy(
                [
                    'email' => $request->request->get('_username', ''),
                ]
            );

            if (!$client || !$client->checkAuthentication($request->request->get('_password', ''))) {
                $error = 'Доступ ограничен, неправильный логин или пароль';
            } else {
                $client->generateToken();
                $em = $this->getDoctrine()->getManager();
                $em->merge($client);
                $em->flush();

                return new RedirectResponse('http://'.$client->getDbRole()->getDomain().'/token/'.$client->getToken());
            }
        }

        return [
            'last_username' => $request->request->get('_username', ''),
            'error' => $error,
        ];
    }

    /**
     * @Route(
     *     path="/mobile",
     *     name="auth_mobile"
     * )
     * @param Request $request
     * @return Response
     */
    public function authMobileAction(Request $request)
    {
        /** @var Client $client */
        $client = $this->getClientRepository()->findOneBy(
            [
                'email' => $request->request->get('_username', ''),
            ]
        );

        if (!$client || !$client->checkAuthentication($request->request->get('_password', ''))) {
            return new Response(
                json_encode(
                    [
                        'last_username' => $request->request->get('_username', ''),
                        'error' => 'Доступ ограничен, неправильный логин или пароль',
                        'auth' => 'failure',
                    ],
                    JSON_UNESCAPED_UNICODE
                ), 200, ['Content-Type' => 'application/json']
            );
        } else {
            $client->generateToken();
            $em = $this->getDoctrine()->getManager();
            $em->merge($client);
            $em->flush();

            return new Response(
                json_encode(
                    [
                        'protocol' => 'https',
                        'host' => $client->getDbRole()->getDomain(),
                        'token' => $client->getToken(),
                        'auth' => 'success',
                    ],
                    JSON_UNESCAPED_UNICODE
                ), 200, ['Content-Type' => 'application/json']
            );
        }
    }

    /**
     * @Route(
     *     path="/token/{token}",
     *     name="token_auth"
     * )
     * @param Request $request
     * @param $token
     * @return RedirectResponse
     */
    public function tokenAction(Request $request, $token)
    {
        /** @var Client $client */
        $client = $this->getClientRepository()->findOneBy(
            [
                'token' => $token,
            ]
        );

        if (!$client) {
            return $this->redirect($request->headers->get('referer'));
        }

        if (!$client->isTokenValid($token)) {
            return $this->redirect($request->headers->get('referer'));
        }

        $token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken($client, null, 'client', array($client->getRole()));
        $this->container->get('security.token_storage')->setToken($token);

        return $this->redirect('/');
    }

}
