<?php

namespace Admin\CatalogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Vermin
 * @ORM\Table(name="vermins", uniqueConstraints={@UniqueConstraint(name="vermin_name", columns={"name"})})
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\VerminRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(errorPath="name", fields={"name"})
 */
class Vermin extends ImageBase {

    protected static $img_dir = 'vermin';

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
     * @Assert\NotNull()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", unique=false, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description1", type="text", unique=false, nullable=true)
     */
    private $dis_description1;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description2", type="text", unique=false, nullable=true)
     */
    private $dis_description2;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description3", type="text", unique=false, nullable=true)
     */
    private $dis_description3;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description4", type="text", unique=false, nullable=true)
     */
    private $dis_description4;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description5", type="text", unique=false, nullable=true)
     */
    private $dis_description5;

    /**
     * @var VerminCategory
     *
     * @ORM\ManyToOne(targetEntity="Admin\CatalogBundle\Entity\VerminCategory", inversedBy="vermins")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $category;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Admin\CatalogBundle\Entity\Entomophage", mappedBy="vermins")
     */
    private $entomophages;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Admin\CatalogBundle\Entity\Chemistry", mappedBy="vermins")
     */
    private $chemistry;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Vermin
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
     * @return Vermin
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
     * @return Vermin
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisDescription1()
    {
        return $this->dis_description1;
    }

    /**
     * @param string $dis_description1
     * @return Vermin
     */
    public function setDisDescription1($dis_description1)
    {
        $this->dis_description1 = $dis_description1;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisDescription2()
    {
        return $this->dis_description2;
    }

    /**
     * @param string $dis_description2
     * @return Vermin
     */
    public function setDisDescription2($dis_description2)
    {
        $this->dis_description2 = $dis_description2;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisDescription3()
    {
        return $this->dis_description3;
    }

    /**
     * @param string $dis_description3
     * @return Vermin
     */
    public function setDisDescription3($dis_description3)
    {
        $this->dis_description3 = $dis_description3;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisDescription4()
    {
        return $this->dis_description4;
    }

    /**
     * @param string $dis_description4
     * @return Vermin
     */
    public function setDisDescription4($dis_description4)
    {
        $this->dis_description4 = $dis_description4;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisDescription5()
    {
        return $this->dis_description5;
    }

    /**
     * @param string $dis_description5
     * @return Vermin
     */
    public function setDisDescription5($dis_description5)
    {
        $this->dis_description5 = $dis_description5;
        return $this;
    }

    /**
     * @return VerminCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param VerminCategory $category
     * @return Vermin
     */
    public function setCategory($category)
    {
        $this->category = $category;
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
     * @return Vermin
     */
    public function setEntomophages($entomophages)
    {
        $this->entomophages = $entomophages;
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
     * @return Vermin
     */
    public function setChemistry($chemistry)
    {
        $this->chemistry = $chemistry;
        return $this;
    }

}