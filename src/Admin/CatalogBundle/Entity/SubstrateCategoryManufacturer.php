<?php

namespace Admin\CatalogBundle\Entity;

use Admin\CatalogBundle\Exception\ChildrenException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class SubstrateCategoryManufacturer
 * @ORM\Table(name="substrate_category_manufacturers", uniqueConstraints={@UniqueConstraint(name="substrate_category_manufacturer", columns={"substrate_category_id", "manufacturer_id"})})
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\SubstrateCategoryManufacturerRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 *  fields={"substrate_category", "manufacturer"},
 *  errorPath="manufacturer",
 *  message="This substrate category already have given manufacturer"
 * )
 */
class SubstrateCategoryManufacturer extends CUBase {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var SubstrateCategory
     *
     * @ORM\ManyToOne(targetEntity="Admin\CatalogBundle\Entity\SubstrateCategory", inversedBy="substrate_category_manufacturers")
     * @ORM\JoinColumn(name="substrate_category_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $substrate_category;

    /**
     * @var Manufacturer
     *
     * @ORM\ManyToOne(targetEntity="Admin\CatalogBundle\Entity\Manufacturer", inversedBy="substrate_category_manufacturers")
     * @ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @Assert\NotNull()
     */
    private $manufacturer;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Admin\CatalogBundle\Entity\Substrate", mappedBy="substrate_category_manufacturer")
     */
    private $substrates;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return SubstrateCategoryManufacturer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return SubstrateCategory
     */
    public function getSubstrateCategory()
    {
        return $this->substrate_category;
    }

    /**
     * @param SubstrateCategory $substrate_category
     * @return SubstrateCategoryManufacturer
     */
    public function setSubstrateCategory($substrate_category)
    {
        $this->substrate_category = $substrate_category;
        return $this;
    }

    /**
     * @return Manufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @param Manufacturer $manufacturer
     * @return SubstrateCategoryManufacturer
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSubstrates()
    {
        return $this->substrates;
    }

    /**
     * @param ArrayCollection $substrates
     * @return SubstrateCategoryManufacturer
     */
    public function setSubstrates($substrates)
    {
        $this->substrates = $substrates;
        return $this;
    }

    /**
     * @ORM\PreRemove()
     */
    public function checkRemove()
    {
        if ($this->substrates->count()) {
            throw new ChildrenException();
        }
    }

}