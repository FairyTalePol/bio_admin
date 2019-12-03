<?php

namespace Admin\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Class Variety
 * @ORM\Table(name="varieties")
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\VarietyRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Variety extends ImageBase
{
    protected static $img_dir = 'varieties';

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
     * @ORM\Column(name="name_en", type="string", nullable=true, unique=true)
     * @NotNull()
     */
    private $name_en;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true, unique=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="description_en", type="text", nullable=true, unique=false)
     */
    private $description_en;

    /**
     * @var string
     *
     * @ORM\Column(name="yield", type="integer", nullable=true, unique=false)
     */
    private $yield;

    /**
     * @var string
     *
     * @ORM\Column(name="form", type="string", nullable=true, unique=false)
     */
    private $form;

    /**
     * @var string
     *
     * @ORM\Column(name="form_en", type="string", nullable=true, unique=false)
     */
    private $form_en;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", nullable=true, unique=false)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="color_en", type="string", nullable=true, unique=false)
     */
    private $color_en;

    /**
     * @var CultureManufacturer
     *
     * @ORM\ManyToOne(targetEntity="Admin\CatalogBundle\Entity\CultureManufacturer", inversedBy="varieties")
     * @ORM\JoinColumn(name="culture_manufacturer_id", referencedColumnName="id", nullable=false)
     * @NotNull(message="Culture Manufacturer should not be null")
     */
    private $culture_manufacturer;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Variety
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
     * @return Variety
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
     * @return Variety
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getYield()
    {
        return $this->yield;
    }

    /**
     * @param string $yield
     * @return Variety
     */
    public function setYield($yield)
    {
        $this->yield = $yield;
        return $this;
    }

    /**
     * @return string
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param string $form
     * @return Variety
     */
    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return Variety
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return CultureManufacturer
     */
    public function getCultureManufacturer()
    {
        return $this->culture_manufacturer;
    }

    /**
     * @param CultureManufacturer $culture_manufacturer
     * @return Variety
     */
    public function setCultureManufacturer($culture_manufacturer)
    {
        $this->culture_manufacturer = $culture_manufacturer;
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
    public function getFormEn(): ?string
    {
        return $this->form_en;
    }

    /**
     * @param string $form_en
     */
    public function setFormEn(string $form_en): void
    {
        $this->form_en = $form_en;
    }

    /**
     * @return string
     */
    public function getColorEn(): ?string
    {
        return $this->color_en;
    }

    /**
     * @param string $color_en
     */
    public function setColorEn(string $color_en): void
    {
        $this->color_en = $color_en;
    }

}
