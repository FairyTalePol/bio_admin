<?php

namespace Admin\CatalogBundle\Entity;

use Admin\CatalogBundle\Exception\ChildrenException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class SubstrateCategory
 * @ORM\Table(name="substrate_categories", uniqueConstraints={@UniqueConstraint(name="substrate_category_name", columns={"name"})})
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\SubstrateCategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(errorPath="name", fields={"name"})
 */
class SubstrateCategory extends CUBase {
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
     * @ORM\OneToMany(targetEntity="Admin\CatalogBundle\Entity\SubstrateCategoryManufacturer", mappedBy="substrate_category")
     */
    private $substrate_category_manufacturers;

    public function __construct() {
        $this->substrate_category_manufacturers = new ArrayCollection();
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
     * @return SubstrateCategory
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
     * @return SubstrateCategory
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSubstrateCategoryManufacturers()
    {
        return $this->substrate_category_manufacturers;
    }

    /**
     * @param ArrayCollection $substrate_category_manufacturers
     * @return SubstrateCategory
     */
    public function setSubstrateCategoryManufacturers($substrate_category_manufacturers)
    {
        $this->substrate_category_manufacturers = $substrate_category_manufacturers;
        return $this;
    }

    /**
     * @ORM\PreRemove()
     */
    public function checkRemove()
    {
        if ($this->substrate_category_manufacturers->count()) {
            throw new ChildrenException();
        }
    }

}