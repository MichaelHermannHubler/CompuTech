<?php
include_once '../dao/AddressDAO.php';
Class Supplier {
    
    private $id;
    private $name;
    private $address;
    private $vatNum;
    
    function __construct($id, $name, $address, $vatNum) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->vatNum;
    }
    
    function getId() {
        return $this->id;
    }
    
    function getName() {
        return $this->name;
    }
    
    function getAddress() {
        $db = new AddressDAO;
                
        $add = $db->getAddress($this->address);
        
        return $add->getStreet().", ".$add->getPostalCode().", ".$add->getCity().", ".$add->getCountryCode();
    }
    
    function getVatNum() {
        return $this->vatNum;
    }
}

