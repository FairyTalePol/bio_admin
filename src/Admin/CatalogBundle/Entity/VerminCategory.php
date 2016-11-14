<?php

namespace Admin\CatalogBundle\Entity;

use Admin\CatalogBundle\Exception\ChildrenException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class VerminCategory
 * @ORM\Table(name="vermin_categories", uniqueConstraints={@UniqueConstraint(name="vermin_category_name", columns={"name"})})
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\VerminCategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(errorPath="name", fields={"name"})
 */
class VerminCategory extends CUBase
{
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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Admin\CatalogBundle\Entity\Vermin", mappedBy="category")
     */
    private $vermins;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return VerminCategory
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
     * @return VerminCategory
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return VerminCategory
     */
    public function setVermins($vermins)
    {
        $this->vermins = $vermins;
        return $this;
    }

    /**
     * @ORM\PreRemove()
     */
    public function checkRemove()
    {
        if ($this->vermins->count()) {
            throw new ChildrenException();
        }
    }

}