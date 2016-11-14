<?php

namespace Admin\LanguageBundle\Entity;

use Admin\ClientBundle\Entity\CUBase;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\Index;

/**
 * Language
 *
 * @ORM\Table(name="translations",uniqueConstraints={@UniqueConstraint(name="translation_uniq", columns={"term_id", "language_id"})}, indexes={@Index(name="translation_search_idx", columns={"language_id", "value"})})
 * @ORM\Entity(repositoryClass="Admin\LanguageBundle\Entity\TranslationRepository")
 * @UniqueEntity(fields={"term", "language"}, errorPath="term", message="Translation for this language already exists")
 * @ORM\HasLifecycleCallbacks()
 */
class Translation extends CUBase
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=false, unique=false)
     */
    private $value;

    /**
     * @var Language
     *
     * @Assert\NotBlank(message="Language should not be empty")
     * @ORM\ManyToOne(targetEntity="Admin\LanguageBundle\Entity\Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id", nullable=false)
     **/
    private $language;

    /**
     * @var Term
     *
     * @Assert\NotBlank(message="Term should not be empty")
     * @ORM\ManyToOne(targetEntity="Admin\LanguageBundle\Entity\Term", cascade={"persist"})
     * @ORM\JoinColumn(name="term_id", referencedColumnName="id", nullable=false)
     **/
    private $term;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return Translation
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param Language $language
     * @return Translation
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return Term
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param Term $term
     * @return Translation
     */
    public function setTerm($term)
    {
        $this->term = $term;
        return $this;
    }

}