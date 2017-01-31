<?php

namespace Admin\CatalogBundle\Entity;

use Admin\CatalogBundle\Exception\ChildrenException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Class Manufacturers
 * @ORM\Table(name="manufacturers", uniqueConstraints={@UniqueConstraint(name="manufacturer_name_type", columns={"name", "manufacturer_type"})})
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\ManufacturerRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(errorPath="name", fields={"name"})
 */
class Manufacturer extends ImageBase
{
    const MANUFACTURER_TYPE_CHEMISTRY = 'chemistry';
    const MANUFACTURER_TYPE_CULTURES = 'cultures';
    const MANUFACTURER_TYPE_SUBSTRATES = 'substrates';
    const MANUFACTURER_TYPE_ENTOMOPHAGES = 'entomophages';

    protected static $img_dir = 'manufacturers';

    public static $logo_size = [
        'width' => 95,
        'height' => 40
    ];

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
     * @ORM\Column(name="name", type="string", nullable=false, unique=true)
     * @NotNull()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="manufacturer_type", type="string", nullable=false, unique=false)
     * @NotNull()
     */
    private $manufacturer_type;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Admin\CatalogBundle\Entity\Provider", mappedBy="manufacturer")
     */
    private $providers;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Admin\CatalogBundle\Entity\CultureManufacturer", mappedBy="manufacturer")
     */
    private $culture_manufacturers;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Admin\CatalogBundle\Entity\Chemistry", mappedBy="manufacturers")
     */
    private $chemistry;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Admin\CatalogBundle\Entity\Entomophage", mappedBy="manufacturers")
     */
    private $entomophages;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Admin\CatalogBundle\Entity\SubstrateCategoryManufacturer", mappedBy="manufacturer")
     */
    private $substrate_category_manufacturers;

    public function __construct() {
        $this->providers = new ArrayCollection();
        $this->culture_manufacturers = new ArrayCollection();
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
     * @return Manufacturer
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
     * @return Manufacturer
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getManufacturerType()
    {
        return $this->manufacturer_type;
    }

    /**
     * @param string $manufacturer_type
     * @return Manufacturer
     */
    public function setManufacturerType($manufacturer_type)
    {
        $this->manufacturer_type = $manufacturer_type;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * @param ArrayCollection $providers
     * @return Manufacturer
     */
    public function setProviders($providers)
    {
        $this->providers = $providers;
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
     * @return Manufacturer
     */
    public function setCultureManufacturers($culture_manufacturers)
    {
        $this->culture_manufacturers = $culture_manufacturers;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getChemistry()
    {
        return $this->chemistry;
    }

    /**
     * @param ArrayCollection $chemistry
     * @return Manufacturer
     */
    public function setChemistry($chemistry)
    {
        $this->chemistry = $chemistry;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getEntomophages()
    {
        return $this->entomophages;
    }

    /**
     * @param ArrayCollection $entomophages
     * @return Manufacturer
     */
    public function setEntomophages($entomophages)
    {
        $this->entomophages = $entomophages;
        return $this;
    }

    /**
     * @ORM\PreRemove()
     */
    public function checkRemove()
    {
        if ($this->providers->count()) {
            throw new ChildrenException();
        }
    }

    public function removeProvider(Provider $provider) {
        $this->providers->removeElement($provider);
    }

    public function addProvider(Provider $provider) {
        $this->providers->add($provider);
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
     * @return Manufacturer
     */
    public function setSubstrateCategoryManufacturers($substrate_category_manufacturers)
    {
        $this->substrate_category_manufacturers = $substrate_category_manufacturers;
        return $this;
    }
}