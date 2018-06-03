<?php
include_once '../../model/Supplier.php';
Class SupplierDAO extends AbstractDAO {

    function __construct() {
        
    }

    function checkSupplier($id) {
        $exists = false;
        $this->doConnect();
        $stmt = $this->conn->prepare("SELECT * from supplier where ID = ?");
        $stmt->bind_param("i", $id);
        
        $stmt->execute();
        
        if($stmt->fetch()){
            $exists = true;
        }

        $this->closeConnect();
        return $exists;
    }
    
    function getSupplierStock() {
        $this->doConnect();
        
        $suppliers = array();
        $stmt = $this->conn->prepare("SELECT ID, Name, AddressID, VatNumber from supplier");
        
        $stmt->execute();
        
        $stmt->bind_result($id, $name, $addressID, $vatNum);
        
        if($stmt->fetch()){
            $supplier = new Supplier($id, $name, $addressID, $vatNum);
            array_push($suppliers, $supplier);
        }

        $this->closeConnect();
        return $suppliers;
    }
    
    function getSupplier() {
        $this->doConnect();
        $stmt = $this->conn->prepare("SELECT ID, Name, AddressID, VatNumber from supplier where ID = ?");
        $stmt->bind_param("i", $id);
        
        $stmt->execute();
        
        $stmt->bind_result($id, $name, $addressID, $vatNum);
        
        if($stmt->fetch()){
            $supplier = new Supplier($id, $name, $addressID, $vatNum);
        }

        $this->closeConnect();
        return $supplier;
    }

}
