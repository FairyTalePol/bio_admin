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
        'width' => 60,
        'height' => 60
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
     * @ORM\Column(name="prophylaxy", type="text", unique=false, nullable=true)
     */
    private $prophylaxy;

    /**
     * @var string
     *
     * @ORM\Column(name="volume", type="integer", unique=false, nullable=true)
     */
    private $volume = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="norm", type="integer", unique=false, nullable=true)
     */
    private $norm = 0;

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

}