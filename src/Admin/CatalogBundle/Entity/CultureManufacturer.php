<?php

namespace Admin\CatalogBundle\Entity;

use Admin\CatalogBundle\Exception\ChildrenException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class CultureManufacturer
 * @ORM\Table(name="culture_manufacturers", uniqueConstraints={@UniqueConstraint(name="culture_manufacturer", columns={"culture_id", "manufacturer_id"})})
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\CultureManufacturerRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 *  fields={"culture", "manufacturer"},
 *  errorPath="manufacturer",
 *  message="This culture already have given manufacturer"
 * )
 */
class CultureManufacturer extends CUBase {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Culture
     *
     * @ORM\ManyToOne(targetEntity="Admin\CatalogBundle\Entity\Culture", inversedBy="culture_manufacturers")
     * @ORM\JoinColumn(name="culture_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $culture;

    /**
     * @var Manufacturer
     *
     * @ORM\ManyToOne(targetEntity="Admin\CatalogBundle\Entity\Manufacturer", inversedBy="culture_manufacturers")
     * @ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @Assert\NotNull()
     */
    private $manufacturer;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Admin\CatalogBundle\Entity\Variety", mappedBy="culture_manufacturer")
     */
    private $varieties;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return CultureManufacturer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Culture
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * @param Culture $culture
     * @return CultureManufacturer
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;
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
     * @return CultureManufacturer
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getVarieties()
    {
        return $this->varieties;
    }

    /**
     * @param ArrayCollection $varieties
     * @return CultureManufacturer
     */
    public function setVarieties($varieties)
    {
        $this->varieties = $varieties;
        return $this;
    }

    /**
     * @ORM\PreRemove()
     */
    public function checkRemove()
    {
        if ($this->varieties->count()) {
            throw new ChildrenException();
        }
    }

}