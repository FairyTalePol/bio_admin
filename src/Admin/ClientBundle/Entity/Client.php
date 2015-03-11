<?php

namespace Admin\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Client
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="email_uniq", columns={"email"}),@UniqueConstraint(name="token_uniq", columns={"token"})})
 * @ORM\Entity(repositoryClass="Admin\ClientBundle\Entity\ClientRepository")
 * @UniqueEntity("email", message="Email already in use")
 * @UniqueEntity("token", message="Token already in use")
 * @ORM\HasLifecycleCallbacks()
 */
class Client implements UserInterface
{
    const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    private static $user_roles = [
        self::ROLE_USER,
        self::ROLE_ADMIN,
        self::ROLE_SUPER_ADMIN
    ];

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
     * @Assert\NotBlank(message="Email should not be empty")
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Password should not be empty")
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Role should not be empty")
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @var DBRole
     *
     * @Assert\NotBlank(message="DB Role should not be empty")
     * @ManyToOne(targetEntity="DBRole", inversedBy="clients")
     * @JoinColumn(name="db_role_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     **/
    private $db_role;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, unique=true)
     */
    private $token;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="token_created", type="datetime", length=255)
     */
    private $token_created;

    /**
     * @var string
     *
     * @ORM\Column(name="reg_ip", type="string", length=255)
     */
    private $reg_ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reg_dtm", type="datetime", length=255)
     */
    private $reg_dtm;

    /**
     * @var string
     *
     * @ORM\Column(name="login_ip", type="string", length=255, nullable=true)
     */
    private $login_ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="login_dtm", type="datetime", length=255, nullable=true)
     */
    private $login_dtm;

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

    private $isPasswordChanged = false;

    public function __construct()
    {
        $this->token = md5(uniqid());
        $this->token_created = new \DateTime();
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
     * Set email
     *
     * @param string $email
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return void
     *
     * @ORM\PreUpdate
     * @ORM\PrePersist
     */
    public function setPasswordSave()
    {
        if ($this->isPasswordChanged) {
            $this->salt = md5(uniqid());
            $encoder = new MessageDigestPasswordEncoder('sha512', true, 10000);
            $this->password = $encoder->encodePassword($this->password, $this->getSalt());
        }
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Client
     */
    public function setPassword($password)
    {
        $this->password = $password;
        $this->isPasswordChanged = true;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $salt
     * @return Client
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Client
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
     * @param DBRole $DBRole
     * @return Client
     */
    public function setDbRole($DBRole)
    {
        $this->db_role = $DBRole;
        return $this;
    }

    /**
     * @return DBRole
     */
    public function getDbRole()
    {
        return $this->db_role;
    }

    /**
     * @param string $token
     * @return Client
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param \DateTime $token_created
     * @return Client
     */
    public function setTokenCreated($token_created)
    {
        $this->token_created = $token_created;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTokenCreated()
    {
        return $this->token_created;
    }

    /**
     * @param \DateTime $login_dtm
     * @return Client
     */
    public function setLoginDtm($login_dtm)
    {
        $this->login_dtm = $login_dtm;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLoginDtm()
    {
        return $this->login_dtm;
    }

    /**
     * @param string $login_ip
     * @return Client
     */
    public function setLoginIp($login_ip)
    {
        $this->login_ip = $login_ip;
        return $this;
    }

    /**
     * @return string
     */
    public function getLoginIp()
    {
        return $this->login_ip;
    }

    /**
     * @param \DateTime $reg_dtm
     * @return Client
     */
    public function setRegDtm($reg_dtm)
    {
        $this->reg_dtm = $reg_dtm;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRegDtm()
    {
        return $this->reg_dtm;
    }

    /**
     * @param string $reg_ip
     * @return Client
     */
    public function setRegIp($reg_ip)
    {
        $this->reg_ip = $reg_ip;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegIp()
    {
        return $this->reg_ip;
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
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return string[] The user roles
     */
    public function getRoles()
    {
        return [$this->role];
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function __sleep()
    {
        //return get_object_vars($this);
        return array(
            'id',
            'email',
            'password',
            'salt',
            'reg_ip',
            'reg_dtm',
            'login_ip',
            'login_dtm'
        );
    }

    /**
     * @return array
     */
    public static function getUserRoles()
    {
        return self::$user_roles;
    }

    public function isTokenValid($token)
    {
        return $token === $this->token && abs(date('U') - $this->token_created->getTimestamp()) < 10;
    }

    public function checkAuthentication($password)
    {
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10000);

        return $this->password === $encoder->encodePassword($password, $this->getSalt());
    }

    public function generateToken()
    {
        $this->token = md5(uniqid());
        $this->token_created = new \DateTime();

        return $this;
    }

}