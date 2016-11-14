<?php

namespace Admin\CatalogBundle\Entity;

use Admin\CatalogBundle\Exception\ChildrenException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Culture
 * @ORM\Table(name="cultures", uniqueConstraints={@UniqueConstraint(name="culture_name", columns={"name"})})
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\CultureRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(errorPath="name", fields={"name"})
 */
class Culture extends CUBase {
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
     * @ORM\Column(name="name", type="string", unique=true, nullable=false)
     * @Assert\NotNull()
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Admin\CatalogBundle\Entity\CultureManufacturer", mappedBy="culture")
     */
    private $culture_manufacturers;

    public function __construct() {
        $this->culture_manufacturers = new ArrayCollection();
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
     * @return Culture
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return Culture
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCultureManufacturers()
    {
        return $this->culture_manufacturers;
    }

    /**
     * @param ArrayCollection $culture_manufacturers
     * @return Culture
     */
    public function setCultureManufacturers($culture_manufacturers)
    {
        $this->culture_manufacturers = $culture_manufacturers;
        return $this;
    }

    /**
     * @ORM\PreRemove()
     */
    public function checkRemove()
    {
        if ($this->culture_manufacturers->count()) {
            throw new ChildrenException();
        }
    }

}