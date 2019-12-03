<?php

namespace Admin\CatalogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Class Entomophage
 * @ORM\Table(name="entomophages", uniqueConstraints={@UniqueConstraint(name="entomophage_name", columns={"name"})})
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\EntomophageCategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(errorPath="name", fields={"name"})
 */
class Entomophage extends ImageBase
{
    protected static $img_dir = 'entomophages';

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
     * @NotNull()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_en", type="string", unique=true, nullable=true)
     * @NotNull()
     */
    private $name_en;

    /**
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", unique=false, nullable=true)
     */
    private $short_name;

    /**
     * @var string
     *
     * @ORM\Column(name="short_name_en", type="string", unique=false, nullable=true)
     */
    private $short_name_en;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", unique=false, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="description_en", type="text", unique=false, nullable=true)
     */
    private $description_en;

    /**
     * @var string
     *
     * @ORM\Column(name="prophylaxy", type="text", unique=false, nullable=true)
     */
    private $prophylaxy;

    /**
     * @var string
     *
     * @ORM\Column(name="prophylaxy_en", type="text", unique=false, nullable=true)
     */
    private $prophylaxy_en;

    /**
     * @var string
     *
     * @ORM\Column(name="norm", type="string", unique=false, nullable=true)
     */
    private $norm;

    /**
     * @var string
     *
     * @ORM\Column(name="norm_en", type="string", unique=false, nullable=true)
     */
    private $norm_en;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Admin\CatalogBundle\Entity\Vermin", inversedBy="entomophages")
     * @ORM\JoinTable(name="entomophagies_vermins")
     */
    private $vermins;

    /**
     * @var EntomophageCategory
     *
     * @ORM\ManyToOne(targetEntity="Admin\CatalogBundle\Entity\EntomophageCategory", inversedBy="entomophages")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     * @NotNull()
     */
    private $category;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Admin\CatalogBundle\Entity\Manufacturer", inversedBy="entomophages")
     * @ORM\JoinTable(name="entomophages_manufacturers",
     *      joinColumns={@ORM\JoinColumn(name="entomophage_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id")}
     *      )
     **/
    private $manufacturers;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Entomophage
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
     * @return Entomophage
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->short_name;
    }

    /**
     * @param string $short_name
     * @return Entomophage
     */
    public function setShortName($short_name)
    {
        $this->short_name = $short_name;
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
     * @return Entomophage
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getProphylaxy()
    {
        return $this->prophylaxy;
    }

    /**
     * @param string $prophylaxy
     * @return Entomophage
     */
    public function setProphylaxy($prophylaxy)
    {
        $this->prophylaxy = $prophylaxy;
        return $this;
    }

    /**
     * @return string
     */
    public function getNorm()
    {
        return $this->norm;
    }

    /**
     * @param string $norm
     * @return Entomophage
     */
    public function setNorm($norm)
    {
        $this->norm = $norm;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getVermins()
    {
        return $this->vermins;
    }

    /**
     * @param ArrayCollection $vermins
     * @return Entomophage
     */
    public function setVermins($vermins)
    {
        $this->vermins = $vermins;
        return $this;
    }

    /**
     * @return \Admin\CatalogBundle\Entity\EntomophageCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param \Admin\CatalogBundle\Entity\EntomophageCategory $category
     * @return Entomophage
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getManufacturers()
    {
        return $this->manufacturers;
    }

    /**
     * @param ArrayCollection $manufacturers
     * @return Entomophage
     */
    public function setManufacturers($manufacturers)
    {
        $this->manufacturers = $manufacturers;
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
    public function getShortNameEn(): ?string
    {
        return $this->short_name_en;
    }

    /**
     * @param string $short_name_en
     */
    public function setShortNameEn(string $short_name_en): void
    {
        $this->short_name_en = $short_name_en;
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

    /**
     * @return string
     */
    public function getProphylaxyEn(): ?string
    {
        return $this->prophylaxy_en;
    }

    /**
     * @param string $prophylaxy_en
     */
    public function setProphylaxyEn(string $prophylaxy_en): void
    {
        $this->prophylaxy_en = $prophylaxy_en;
    }

    /**
     * @return string
     */
    public function getNormEn(): ?string
    {
        return $this->norm_en;
    }

    /**
     * @param string $norm_en
     */
    public function setNormEn(string $norm_en): void
    {
        $this->norm_en = $norm_en;
    }
}
