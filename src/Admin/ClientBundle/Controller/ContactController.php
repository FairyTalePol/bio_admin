<?php
/**
 * Created by PhpStorm.
 * User: Dima S.
 * Date: 22.04.14
 * Time: 10:52
 */
namespace Admin\ClientBundle\Controller;

use Admin\ClientBundle\Entity\Contact;
use Admin\ClientBundle\Form\ContactType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;

/**
 * Contact controller.
 *
 * @Route("/contact")
 */
class ContactController extends DefaultController
{
    /**
     * @Route("/", name="contact")
     * @Method("POST")
     * @Template()
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function contactAction(Request $request)
    {
        /* Config file for contact form */
        $conf = Yaml::parse(file_get_contents(__DIR__.'/../Resources/config/config.yml'));

        if ($this->get('session')->getFlashBag()->has('old-value')){
            $contact = $this->get('session')->getFlashBag()->get('old-value')[0];
        } else {
            $contact = new Contact();
        }

        $form = $this->createForm(new ContactType(), $contact, [
            'error_bubbling' => true
        ]);

        if ($request->getMethod() === 'POST') {
            $form->submit($request);

            if ($form->isValid()) {
                $userIP = $_SERVER['REMOTE_ADDR'];
                $userHostname = gethostbyaddr($userIP);

                $message = \Swift_Message::newInstance()
                    ->setSubject($conf['parameters']['admin_client.mail_subject'])
                    ->setFrom([
                        $conf['parameters']['admin_client.email_from'] => $conf['parameters']['admin_client.name_from']
                    ])
                    ->setTo([
                        $conf['parameters']['admin_client.email_to'] => $conf['parameters']['admin_client.name_to']
                    ])
                    ->setBody($this->renderView('AdminClientBundle:Contact:contactEmail.txt.twig', array(
                        'mail' => $contact,
                        'ip' => $userIP,
                        'hostname' => $userHostname
                    )));
                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add('form-notice', 'Ваш запрос на демо успешно отправлен. Наш менеджер свяжется с Вами в ближайшее время!');

                return $this->redirect($this->generateUrl('auth'));
            } else {
                $this->get('session')->getFlashBag()->add('form-errors', $form->getErrors());
                $this->get('session')->getFlashBag()->add('old-value', $contact);
                return $this->redirect($this->generateUrl('auth'));
            }
        }

        return [
            'form' => $form->createView()
        ];
    }
}