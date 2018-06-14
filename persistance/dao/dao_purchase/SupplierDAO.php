<?php


Class SupplierDAO extends AbstractDAO {

    function __construct() {
        
    }

    function checkSupplier($id) {        
        $this->doConnect();
        $exists = false;
        $stmt = $this->conn->prepare("SELECT * from supplier where ID = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();

        if ($stmt->fetch()) {
            $exists = true;
        }

        $this->closeConnect();
        return $exists;
    }

    function getSupplierStock() {
        $this->doConnect();


        $stmt = $this->conn->prepare("SELECT ID, Name, AddressID, VatNumber from supplier");

        $stmt->execute();
        $suppliers = array();
        $stmt->bind_result($id, $name, $addressID, $vatNum);

        while ($stmt->fetch()) {
            $supplier = new Supplier($id, $name, $addressID, $vatNum);
            array_push($suppliers, $supplier);
        }

        $this->closeConnect();
        return $suppliers;
    }

    function getSupplier($id) {
        $this->doConnect();
        $stmt = $this->conn->prepare("SELECT ID, Name, AddressID, VatNumber from supplier where ID = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();

        $stmt->bind_result($id, $name, $addressID, $vatNum);

        if ($stmt->fetch()) {
            $supplier = new Supplier($id, $name, $addressID, $vatNum);
        }

        $this->closeConnect();
        return $supplier;
    }
    
    function getSupplierIDByName($name){
        $this->doConnect();
        
        $stmt = $this->conn->prepare("SELECT ID from supplier where Name = ?");
        
        $stmt->bind_param("s", $name);
        
        $stmt->execute();
        
        $stmt->bind_result($id);
        
        if($stmt->fetch()){
            $id = $id;
        }
        
        $this->closeConnect();
        
        return $id;
    }

}
