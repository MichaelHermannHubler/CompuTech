<?php

Class Address {
    
    private $id;
    private $street;
    private $city;
    private $postalCode;
    private $countryCode;
    
    function __construct($id, $street, $city, $postCode, $country) {
        $this->id = $id;
        $this->street = $street;
        $this->city = $city;
        $this->postalCode = $postCode;
        $this->countryCode = $country;
    }
    
    function getId() {
        return $this->id;
    }
    
    function getStreet() {
        return $this->street;
    }
    
    function getCity() {
        return $this->city;
    }
    
    function getPostalCode() {
        return $this->postalCode;
    }
    
    function getCountryCode() {
        return $this->countryCode;
    }
}

