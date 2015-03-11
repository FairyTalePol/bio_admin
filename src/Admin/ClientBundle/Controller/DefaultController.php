<?php

namespace Admin\ClientBundle\Controller;

use Admin\ClientBundle\Entity\ClientRepository;
use Admin\ClientBundle\Entity\DBRoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @return ClientRepository
     */
    public function getClientRepository() {
        return $this->getDoctrine()->getRepository('AdminClientBundle:Client');
    }

    /**
     * @return DBRoleRepository
     */
    public function getDBRoleRepository() {
        return $this->getDoctrine()->getRepository('AdminClientBundle:DBRole');
    }
}
