<?php

namespace Admin\CatalogBundle\Entity;

use Admin\CatalogBundle\Exception\ChildrenException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class EntomophageCategory
 * @ORM\Table(name="entomophages_categories", uniqueConstraints={@UniqueConstraint(name="entomophage_category_name", columns={"name"})})
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\EntomophageCategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(errorPath="name", fields={"name"})
 */
class EntomophageCategory extends CUBase {
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
     * @ORM\OneToMany(targetEntity="Admin\CatalogBundle\Entity\Entomophage", mappedBy="category")
     */
    private $entomophages;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return EntomophageCategory
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
     * @return EntomophageCategory
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return EntomophageCategory
     */
    public function setEntomophages($entomophages)
    {
        $this->entomophages = $entomophages;
        return $this;
    }

    /**
     * @ORM\PreRemove()
     */
    public function checkRemove()
    {
        if ($this->entomophages->count()) {
            throw new ChildrenException();
        }
    }

}