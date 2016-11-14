<?php

namespace Admin\LanguageBundle\Entity;

use Admin\ClientBundle\Entity\CUBase;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Term
 *
 * @ORM\Table(name="terms")
 * @ORM\Entity(repositoryClass="Admin\LanguageBundle\Entity\TermRepository")
 * @UniqueEntity(fields={"name"}, errorPath="name", message="Term already exists")
 * @ORM\HasLifecycleCallbacks()
 */
class Term extends CUBase
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     */
    private $name;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Language
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @ORM\PreUpdate()
     * @ORM\PrePersist()
     */
    public function beforeSave()
    {
        $this->name = mb_strtolower($this->name, 'utf-8');
    }

}