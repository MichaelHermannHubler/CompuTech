<?php

Class Address {
    
    private $id;
    private $street;
    private $city;
    private $postalCode;
    private $countryCode;
    private $name;
    
    function __construct($id, $street, $city, $postCode, $country, $name) {
        $this->id = $id;
        $this->street = $street;
        $this->city = $city;
        $this->postalCode = $postCode;
        $this->countryCode = $country;
        $this->name = $name;
    }


    function setAddress($id, $street, $city, $postCode, $countryCode) {
        $this->id = $id;
        
        $this->street = $street;
        
        $this->city = $city;
        
        $this->postalCode = $postCode;
        
        $this->countryCode = $countryCode;
        
        $db = new AddressDAO;
        
        if($this->id == null){
            $this->id = $db->setAddress($this->id, $this->street, $this->city, $this->postalCode, $this->countryCode);
        }else{
            $db->setAddress($this->id, $this->street, $this->city, $this->postalCode, $this->countryCode);
        }
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

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}

