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
     * @ORM\Column(name="short_name", type="string", unique=false, nullable=true)
     */
    private $short_name;

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
     * @ORM\Column(name="norm", type="string", unique=false, nullable=true)
     */
    private $norm;

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

}