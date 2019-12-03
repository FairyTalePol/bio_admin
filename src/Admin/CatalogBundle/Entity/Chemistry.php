<?php

namespace Admin\CatalogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Class Chemistry
 * @ORM\Table(name="chemistry", uniqueConstraints={@UniqueConstraint(name="chemistry_name", columns={"name"})})
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\ChemistryRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(errorPath="name", fields={"name"})
 */
class Chemistry extends ImageBase {

    protected static $img_dir = 'chemistry';

    public static $logo_size = [
        'width' => 100,
        'height' => 100
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
     * @ORM\Column(name="substance", type="string", unique=false, nullable=true)
     */
    private $substance;

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
     * @ORM\Column(name="volume", type="string", unique=false, nullable=true)
     */
    private $volume;

    /**
     * @var string
     *
     * @ORM\Column(name="volume_en", type="string", unique=false, nullable=true)
     */
    private $volume_en;

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
     * @var string
     *
     * @ORM\Column(name="chemistry_class", type="string", unique=false, nullable=true)
     */
    private $chemistry_class;

    /**
     * @var string
     *
     * @ORM\Column(name="chemistry_class_en", type="string", unique=false, nullable=true)
     */
    private $chemistry_class_en;

    /**
     * @var string
     *
     * @ORM\Column(name="action_mechanism", type="string", unique=false, nullable=true)
     */
    private $action_mechanism;

    /**
     * @var string
     *
     * @ORM\Column(name="action_mechanism_en", type="string", unique=false, nullable=true)
     */
    private $action_mechanism_en;

    /**
     * @var string
     *
     * @ORM\Column(name="waiting_time", type="integer", unique=false, nullable=true)
     */
    private $waiting_time;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Admin\CatalogBundle\Entity\Vermin", inversedBy="chemistry")
     * @ORM\JoinTable(name="chemistry_vermins")
     */
    private $vermins;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Admin\CatalogBundle\Entity\Blight", inversedBy="chemistry")
     * @ORM\JoinTable(name="chemistry_blights")
     */
    private $blights;

    /**
     * @var ChemistryCategory
     *
     * @ORM\ManyToOne(targetEntity="Admin\CatalogBundle\Entity\ChemistryCategory", inversedBy="chemistry")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     * @NotNull()
     */
    private $category;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Admin\CatalogBundle\Entity\Manufacturer", inversedBy="chemistry")
     * @ORM\JoinTable(name="chemistry_manufacturers",
     *      joinColumns={@ORM\JoinColumn(name="chemistry_id", referencedColumnName="id")},
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
     * @return Chemistry
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
     * @return Chemistry
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubstance()
    {
        return $this->substance;
    }

    /**
     * @param string $substance
     * @return Chemistry
     */
    public function setSubstance($substance)
    {
        $this->substance = $substance;
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
     * @return Chemistry
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
     * @return Chemistry
     */
    public function setProphylaxy($prophylaxy)
    {
        $this->prophylaxy = $prophylaxy;
        return $this;
    }

    /**
     * @return string
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param string $volume
     * @return Chemistry
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
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
     * @return Chemistry
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
     * @return Chemistry
     */
    public function setVermins($vermins)
    {
        $this->vermins = $vermins;
        return $this;
    }

    /**
     * @return ChemistryCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param ChemistryCategory $category
     * @return Chemistry
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
     * @return Chemistry
     */
    public function setManufacturers($manufacturers)
    {
        $this->manufacturers = $manufacturers;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getBlights()
    {
        return $this->blights;
    }

    /**
     * @param ArrayCollection $blights
     * @return Chemistry
     */
    public function setBlights($blights)
    {
        $this->blights = $blights;
        return $this;
    }

    /**
     * @return string
     */
    public function getChemistryClass()
    {
        return $this->chemistry_class;
    }

    /**
     * @param string $chemistry_class
     * @return Chemistry
     */
    public function setChemistryClass($chemistry_class)
    {
        $this->chemistry_class = $chemistry_class;
        return $this;
    }

    /**
     * @return string
     */
    public function getActionMechanism()
    {
        return $this->action_mechanism;
    }

    /**
     * @param string $action_mechanism
     * @return Chemistry
     */
    public function setActionMechanism($action_mechanism)
    {
        $this->action_mechanism = $action_mechanism;
        return $this;
    }

    /**
     * @return string
     */
    public function getWaitingTime()
    {
        return $this->waiting_time;
    }

    /**
     * @param string $waiting_time
     * @return Chemistry
     */
    public function setWaitingTime($waiting_time)
    {
        $this->waiting_time = $waiting_time;
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
    public function getVolumeEn(): ?string
    {
        return $this->volume_en;
    }

    /**
     * @param string $volume_en
     */
    public function setVolumeEn(string $volume_en): void
    {
        $this->volume_en = $volume_en;
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

    /**
     * @return string
     */
    public function getChemistryClassEn(): ?string
    {
        return $this->chemistry_class_en;
    }

    /**
     * @param string $chemistry_class_en
     */
    public function setChemistryClassEn(string $chemistry_class_en): void
    {
        $this->chemistry_class_en = $chemistry_class_en;
    }

    /**
     * @return string
     */
    public function getActionMechanismEn(): ?string
    {
        return $this->action_mechanism_en;
    }

    /**
     * @param string $action_mechanism_en
     */
    public function setActionMechanismEn(string $action_mechanism_en): void
    {
        $this->action_mechanism_en = $action_mechanism_en;
    }

}
