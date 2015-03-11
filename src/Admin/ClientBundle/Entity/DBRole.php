<?php

namespace Admin\ClientBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * DBRole
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="pg_role_uniq", columns={"role"}),@UniqueConstraint(name="domain_uniq", columns={"domain"})})
 * @ORM\Entity(repositoryClass="Admin\ClientBundle\Entity\DBRoleRepository")
 * @UniqueEntity("role", message="DB Role already in use")
 * @UniqueEntity("domain", message="Domain already in use")
 * @ORM\HasLifecycleCallbacks()
 */
class DBRole
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
   * @Assert\NotBlank(message="DB Role should not be empty")
   * @ORM\Column(name="role", type="string", length=255, unique=true)
   */
  private $role;

  /**
   * @var string
   *
   * @Assert\NotBlank(message="Domain should not be empty")
   * @ORM\Column(name="domain", type="string", length=255, unique=true)
   */
  private $domain;

  /**
   * @var ArrayCollection
   *
   * @OneToMany(targetEntity="Client", mappedBy="db_role")
   */
  private $clients;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="created", type="datetime")
   */
  private $created;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="updated", type="datetime")
   */
  private $updated;


  /**
   * @var string
   */
  private $password;

  public function __construct()
  {
    $this->clients = new ArrayCollection();
  }

  /**
   * Get id
   *
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set role
   *
   * @param string $role
   * @return DBRole
   */
  public function setRole($role)
  {
    $this->role = $role;

    return $this;
  }

  /**
   * Get role
   *
   * @return string
   */
  public function getRole()
  {
    return $this->role;
  }

  /**
   * Set domain
   *
   * @param string $domain
   * @return DBRole
   */
  public function setDomain($domain)
  {
    $this->domain = $domain;

    return $this;
  }

  /**
   * Get domain
   *
   * @return string
   */
  public function getDomain()
  {
    return $this->domain;
  }

  /**
   * @param \Doctrine\Common\Collections\ArrayCollection $clients
   * @return DBRole
   */
  public function setClients($clients)
  {
    $this->clients = $clients;
    return $this;
  }

  /**
   * @param Client $client
   * @return $this
   */
  public function addClient(Client $client)
  {
    $this->clients->add($client);

    return $this;
  }

  /**
   * @param Client $client
   * @return $this
   */
  public function removeClient(Client $client)
  {
    $this->clients->removeElement($client);

    return $this;
  }

  /**
   * @return \Doctrine\Common\Collections\ArrayCollection
   */
  public function getClients()
  {
    return $this->clients;
  }

  /**
   * @ORM\PrePersist()
   *
   * @return Client
   */
  public function setCreated()
  {
    $this->created = new \DateTime();
    $this->updated = new \DateTime();

    return $this;
  }

  /**
   * @return \DateTime
   */
  public function getCreated()
  {
    return $this->created;
  }

  /**
   * @ORM\PreUpdate()
   *
   * @return Client
   */
  public function setUpdated()
  {
    $this->updated = new \DateTime();

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
   * @param mixed $password
   * @return DBRole
   */
  public function setPassword($password)
  {
    $this->password = $password;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getPassword()
  {
    return $this->password;
  }

}
