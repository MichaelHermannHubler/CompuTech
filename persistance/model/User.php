<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 24.05.2018
 * Time: 18:40
 */

Class User
{



    private $username;
    private $password;
    private $firstname;
    private $lastname;
    private $adressId;
    private $pwSalt;

    /**
     * User constructor.
     * @param $username
     * @param $password
     * @param $firstname
     * @param $lastname
     * @param $adressId
     */
    public function __construct($username, $password, $firstname, $lastname, $adressId)
    {
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->adressId = $adressId;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getAdressId()
    {
        return $this->adressId;
    }

    /**
     * @param mixed $adressId
     */
    public function setAdressId($adressId)
    {
        $this->adressId = $adressId;
    }

    /**
     * @return mixed
     */
    public function getPwSalt()
    {
        return $this->pwSalt;
    }

    /**
     * @param mixed $pwSalt
     */
    public function setPwSalt($pwSalt)
    {
        $this->pwSalt = $pwSalt;
    }



}