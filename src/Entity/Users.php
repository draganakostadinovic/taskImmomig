<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity (repositoryClass="\App\Repository\UsersRepository")
 * @ORM\Table(name="users")
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string") */
    private $name;

    /** @ORM\Column(type="string") */
    private $surname;

    /** @ORM\Column(type="string") */
    private $username;

    /** @ORM\Column(type="string") */
    private $password;

    public function __construct($name, $surname, $username, $password) {
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /** @param $id */
    public function setId($id) {
        $this->id = $id;
    }

    /** @return int */
    public function getId() {
        return $this->id;
    }

    /** @param $name */
    public function setName($name) {
        $this->name = $name;
    }

    /** @return string */
    public function getName() {
        return $this->name;
    }

    /** @param $surname */
    public function setSurame($surname) {
        $this->surname = $surname;
    }

    /** @return string */
    public function getSurame() {
        return $this->surname;
    }

    /** @param $username */
    public function setUsername($username) {
        $this->username = $username;
    }

    /** @return string */
    public function getUsername() {
        return $this->username;
    }

    /** @param $password */
    public function setPassword($password) {
        $this->password = $password;
    }

    /** @return string */
    public function getPassword() {
        return $this->password;
    }
}
