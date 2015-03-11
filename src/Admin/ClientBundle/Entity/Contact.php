<?php
/**
 * Created by PhpStorm.
 * User: Dima S.
 * Date: 22.04.14
 * Time: 11:38
 */

namespace Admin\ClientBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\NotBlank(message = "Введите Ваше имя.")
     */
    protected $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Email(message = "Почтовый ящик '{{ value }}' некорректный", checkMX = true)
     */
    protected $email;

    /**
     * @Assert\NotBlank(message = "Введите Ваш номер телефона")
     */
    protected $tel;

    protected $body;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }


} 