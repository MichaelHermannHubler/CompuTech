<?php

Class SupplierDAO extends AbstractDAO {

    function __construct() {
        
    }

    function getSupplier($id) {
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

}
