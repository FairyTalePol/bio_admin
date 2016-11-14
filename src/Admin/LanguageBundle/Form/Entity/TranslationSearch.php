<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/6/15
 * Time: 10:47 AM
 */

namespace Admin\LanguageBundle\Form\Entity;


use Admin\LanguageBundle\Entity\Language;

class TranslationSearch
{
    const PER_PAGE = 15;

    /**
     * @var int
     */
    private $id;

    /**
     * @var Language
     */
    private $language;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $term;

    /**
     * @var int
     */
    private $page = 1;

    /**
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param Language $language
     * @return TranslationSearch
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return TranslationSearch
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param string $term
     * @return TranslationSearch
     */
    public function setTerm($term)
    {
        $this->term = $term;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return TranslationSearch
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return TranslationSearch
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


}