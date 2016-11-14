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
     * @ORM\Column(name="description", type="text", nullable=true, unique=false)
     */
    private $description;

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
     * @ORM\Column(name="color", type="string", nullable=true, unique=false)
     */
    private $color;

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

}