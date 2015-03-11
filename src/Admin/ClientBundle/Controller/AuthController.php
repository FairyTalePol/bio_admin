<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/24/14
 * Time: 1:59 PM
 */
namespace Admin\ClientBundle\Controller;

use Admin\ClientBundle\Entity\Client;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;


/**
 * Auth controller.
 *
 * @Route("/")
 */
class AuthController extends DefaultController
{
    /**
     * @Route("/", name="auth")
     * @Template()
     * @param Request $request
     * @return array|RedirectResponse
     */
    public function indexAction(Request $request)
    {
        $error = null;

        if ($request->getMethod() === 'POST') {

            /** @var Client $client */
            $client = $this->getClientRepository()->findOneBy(
                [
                    'email' => $request->request->get('_username', '')
                ]
            );

            if (!$client || !$client->checkAuthentication($request->request->get('_password', ''))) {
                $error = 'Доступ ограничен, неправильный логин или пароль';
            } else {
                $client->generateToken();
                $em = $this->getDoctrine()->getManager();
                $em->merge($client);
                $em->flush();
                return new RedirectResponse('http://' . $client->getDbRole()->getDomain() . '/token/' . $client->getToken());
            }
        }

        return [
            'last_username' => $request->request->get('_username', ''),
            'error' => $error
        ];
    }

    /**
     * @Route("/mobile", name="auth_mobile")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function authMobileAction(Request $request)
    {
        /** @var Client $client */
        $client = $this->getClientRepository()->findOneBy(
            [
                'email' => $request->request->get('_username', '')
            ]
        );

        if (!$client || !$client->checkAuthentication($request->request->get('_password', ''))) {
            return new Response(json_encode([
                'last_username' => $request->request->get('_username', ''),
                'error' => 'Доступ ограничен, неправильный логин или пароль',
                'auth' => 'failure'
            ], JSON_UNESCAPED_UNICODE), 200, ['Content-Type' => 'application/json']);
        } else {
            $client->generateToken();
            $em = $this->getDoctrine()->getManager();
            $em->merge($client);
            $em->flush();
            return new RedirectResponse('http://' . $client->getDbRole()->getDomain() . '/token/' . $client->getToken() . '/mobile');
        }
    }

    /**
     * @Route("/token/{token}", name="token_auth")
     * @param Request $request
     * @param $token
     * @return RedirectResponse
     */
    public function tokenAction(Request $request, $token)
    {
        /** @var Client $client */
        $client = $this->getClientRepository()->findOneBy(
            [
                'token' => $token
            ]
        );

        if (!$client) {
            return $this->redirect($request->headers->get('referer'));
        }

        if (!$client->isTokenValid($token)) {
            return $this->redirect($request->headers->get('referer'));
        }

        $token = new UsernamePasswordToken($client, null, 'client', array($client->getRole()));
        $this->container->get('security.context')->setToken($token);

        return $this->redirect('/');
    }

} 