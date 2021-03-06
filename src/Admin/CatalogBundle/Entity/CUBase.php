<?php

namespace Admin\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Class CUBase
 * @package Admin\CatalogBundle\Entity
 * @ORM\MappedSuperclass()
 * @ORM\HasLifecycleCallbacks()
 */
abstract class CUBase
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return CUBase
     * @ORM\PrePersist()
     */
    public function setCreated()
    {
        $this->created = $this->updated = new \DateTime();
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @return CUBase
     * @ORM\PreUpdate()
     */
    public function setUpdated()
    {
        $this->updated = new \DateTime();
        return $this;
    }
}