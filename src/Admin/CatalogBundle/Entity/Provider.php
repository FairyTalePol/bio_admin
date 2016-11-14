<?php

namespace Admin\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Provider
 * @ORM\Table(name="providers")
 * @ORM\Entity(repositoryClass="Admin\CatalogBundle\Entity\ProviderRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Provider extends CUBase
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
     * @ORM\Column(name="fio", type="string", nullable=true, unique=false)
     */
    private $fio;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", nullable=true, unique=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", nullable=true, unique=false)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", nullable=true, unique=false)
     */
    private $email;

    /**
     * @var Manufacturer
     *
     * @ORM\ManyToOne(targetEntity="Admin\CatalogBundle\Entity\Manufacturer", inversedBy="providers",cascade={"persist"})
     * @ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $manufacturer;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Provider
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFio()
    {
        return $this->fio;
    }

    /**
     * @param string $fio
     * @return Provider
     */
    public function setFio($fio)
    {
        $this->fio = $fio;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Provider
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     * @return Provider
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Provider
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return Manufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @param Manufacturer $manufacturer
     * @return Provider
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }
}