<?php

namespace Admin\LanguageBundle\Controller;

use Admin\LanguageBundle\Entity\LanguageRepository;
use Admin\LanguageBundle\Entity\TermRepository;
use Admin\LanguageBundle\Entity\TranslationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @return LanguageRepository
     */
    public function getLanguageRepository()
    {
        return $this->getDoctrine()->getRepository('AdminLanguageBundle:Language');
    }

    /**
     * @return TranslationRepository
     */
    public function getTranslationRepository()
    {
        return $this->getDoctrine()->getRepository('AdminLanguageBundle:Translation');
    }

    /**
     * @return TermRepository
     */
    public function getTermRepository()
    {
        return $this->getDoctrine()->getRepository('AdminLanguageBundle:Term');
    }
}
