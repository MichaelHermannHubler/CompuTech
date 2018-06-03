<?php

Class PurchaseOrderDAO extends AbstractDAO {

    function __construct() {
        
    }
    
    function getPurchaseOrder() {
        $this->doConnect();
        $stmt = $this->conn->prepare("");
        $stmt->execute();
        
        $this->closeConnect();
    }
    
    function setPurchaseOrder() {
        $this->doConnect();
        $stmt = $this->conn->prepare("");
        
        $stmt->execute();
        
        $this->closeConnect();
    }
    
    function getUnorderedPurchaseOrder($supplierId){
        $found = false;
        $this->doConnect();
        $stmt = $this->conn->prepare("select ID from purchaseorder where SuplierID = ? and OrderDate = null");
        $stmt->bind_param("i", $supplierId);
        $stmt->execute();
        $stmt->bind_result($id);
       
        if($stmt->fetch()){
            $id = $id;
        }
        $this->closeConnect();
        return $id;
    }

}
