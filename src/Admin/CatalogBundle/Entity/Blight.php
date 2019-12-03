<?php

namespace Admin\CatalogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class blight
 * @ORM\Table(name="blights", uniqueConstraints={@UniqueConstraint(name="blight_name", columns={"name"})})
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\BlightRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(errorPath="name", fields={"name"})
 */
class Blight extends ImageBase {

    protected static $img_dir = 'blight';

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
     * @ORM\Column(name="name_en", type="string", unique=true, nullable=true)
     * @Assert\NotNull()
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
     * @Assert\NotNull()
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
     * @Assert\NotNull()
     */
    private $description_en;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description1", type="text", unique=false, nullable=true)
     */
    private $dis_description1;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description1_en", type="text", unique=false, nullable=true)
     * @Assert\NotNull()
     */
    private $dis_description1_en;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description2", type="text", unique=false, nullable=true)
     */
    private $dis_description2;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description2_en", type="text", unique=false, nullable=true)
     * @Assert\NotNull()
     */
    private $dis_description2_en;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description3", type="text", unique=false, nullable=true)
     */
    private $dis_description3;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description3_en", type="text", unique=false, nullable=true)
     * @Assert\NotNull()
     */
    private $dis_description3_en;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description4", type="text", unique=false, nullable=true)
     */
    private $dis_description4;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description4_en", type="text", unique=false, nullable=true)
     * @Assert\NotNull()
     */
    private $dis_description4_en;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description5", type="text", unique=false, nullable=true)
     */
    private $dis_description5;

    /**
     * @var string
     *
     * @ORM\Column(name="dis_description5_en", type="text", unique=false, nullable=true)
     * @Assert\NotNull()
     */
    private $dis_description5_en;

    /**
     * @var BlightCategory
     *
     * @ORM\ManyToOne(targetEntity="Admin\CatalogBundle\Entity\BlightCategory", inversedBy="blights")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $category;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Admin\CatalogBundle\Entity\Chemistry", mappedBy="blights")
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
     * @return Blight
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
     * @return Blight
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
     * @return Blight
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
     * @return Blight
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
     * @return Blight
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
     * @return Blight
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
     * @return Blight
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
     * @return Blight
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
     * @return Blight
     */
    public function setDisDescription5($dis_description5)
    {
        $this->dis_description5 = $dis_description5;
        return $this;
    }

    /**
     * @return BlightCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param BlightCategory $category
     * @return Blight
     */
    public function setCategory($category)
    {
        $this->category = $category;
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
     * @return Blight
     */
    public function setChemistry($chemistry)
    {
        $this->chemistry = $chemistry;
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
    public function getDisDescription1En(): ?string
    {
        return $this->dis_description1_en;
    }

    /**
     * @param string $dis_description1_en
     */
    public function setDisDescription1En(string $dis_description1_en): void
    {
        $this->dis_description1_en = $dis_description1_en;
    }

    /**
     * @return string
     */
    public function getDisDescription2En(): ?string
    {
        return $this->dis_description2_en;
    }

    /**
     * @param string $dis_description2_en
     */
    public function setDisDescription2En(string $dis_description2_en): void
    {
        $this->dis_description2_en = $dis_description2_en;
    }

    /**
     * @return string
     */
    public function getDisDescription3En(): ?string
    {
        return $this->dis_description3_en;
    }

    /**
     * @param string $dis_description3_en
     */
    public function setDisDescription3En(string $dis_description3_en): void
    {
        $this->dis_description3_en = $dis_description3_en;
    }

    /**
     * @return string
     */
    public function getDisDescription4En(): ?string
    {
        return $this->dis_description4_en;
    }

    /**
     * @param string $dis_description4_en
     */
    public function setDisDescription4En(string $dis_description4_en): void
    {
        $this->dis_description4_en = $dis_description4_en;
    }

    /**
     * @return string
     */
    public function getDisDescription5En(): ?string
    {
        return $this->dis_description5_en;
    }

    /**
     * @param string $dis_description5_en
     */
    public function setDisDescription5En(string $dis_description5_en): void
    {
        $this->dis_description5_en = $dis_description5_en;
    }
}
