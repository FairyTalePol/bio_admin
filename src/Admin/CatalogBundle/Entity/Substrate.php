<?php

namespace Admin\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Substrate
 * @ORM\Table(name="substrates")
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\SubstrateRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Substrate extends ImageBase
{
    protected static $img_dir = 'substrates';

    public static $logo_size = [
        'width' => 95,
        'height' => 40
    ];

    const SUBSTRATE_TYPE_KUB = 'SUBSTRATE_TYPE_CUBE';
    const SUBSTRATE_TYPE_MAT = 'SUBSTRATE_TYPE_MAT';
    const SUBSTRATE_TYPE_DISK = 'SUBSTRATE_TYPE_DISK';
    const SUBSTRATE_TYPE_BLOCK = 'SUBSTRATE_TYPE_BLOCK';

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
     * @ORM\Column(name="name", type="string", nullable=false, unique=false)
     * @Assert\NotNull()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_en", type="string", nullable=true, unique=false)
     * @Assert\NotNull()
     */
    private $name_en;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false, unique=false)
     * @Assert\NotNull()
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="description_en", type="text", nullable=true, unique=false)
     * @Assert\NotNull()
     */
    private $description_en;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="text", nullable=false, unique=false)
     * @Assert\NotNull()
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="substrate_type", type="string", nullable=false, unique=false)
     * @Assert\NotNull()
     */
    private $substrate_type;

    /**
     * @var SubstrateCategory
     *
     * @ORM\ManyToOne(targetEntity="Admin\CatalogBundle\Entity\SubstrateCategoryManufacturer", inversedBy="substrates")
     * @ORM\JoinColumn(name="substrate_category_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $substrate_category_manufacturer;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Substrate
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
     * @return Substrate
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Substrate
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $size
     * @return Substrate
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubstrateType()
    {
        return $this->substrate_type;
    }

    /**
     * @param string $substrate_type
     * @return Substrate
     */
    public function setSubstrateType($substrate_type)
    {
        $this->substrate_type = $substrate_type;
        return $this;
    }

    /**
     * @return SubstrateCategory
     */
    public function getSubstrateCategoryManufacturer()
    {
        return $this->substrate_category_manufacturer;
    }

    /**
     * @param SubstrateCategory $substrate_category_manufacturer
     * @return Substrate
     */
    public function setSubstrateCategoryManufacturer($substrate_category_manufacturer)
    {
        $this->substrate_category_manufacturer = $substrate_category_manufacturer;
        return $this;
    }

    /**
     * @return string
     */
    public function getNameEn(): ?string
    {
        return $this->name_en;
    }

    /**
     * @param string $name_en
     */
    public function setNameEn(string $name_en): void
    {
        $this->name_en = $name_en;
    }

    /**
     * @return string
     */
    public function getDescriptionEn(): ?string
    {
        return $this->description_en;
    }

    /**
     * @param string $description_en
     */
    public function setDescriptionEn(string $description_en): void
    {
        $this->description_en = $description_en;
    }
}
