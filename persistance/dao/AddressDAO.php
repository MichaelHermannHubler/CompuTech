<?php

Class AddressDAO extends AbstractDAO{
    
    
    function __construct() {
       
    }
    
    function getAddress($id) {
        $this->doConnect();
        
        $stmt = $this->conn->prepare("select ID, Street, City, PostalCode, CountryCode from address where ID = ?");
        
        $stmt->bind_param("i", $id);
        
        $stmt->execute();
        
        $stmt->bind_result($ID, $street, $city, $postalCode, $countryCode);
        
        if($stmt->fetch()){
            $address = new Address($ID, $street, $city, $postalCode, $countryCode);
        }
        
        $this->closeConnect();
        return $address;
    }
}
