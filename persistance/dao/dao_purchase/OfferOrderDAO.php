<?php

Class OfferOrderDAO extends AbstractDAO {

    function __construct() {
        
    }
    
    function getOfferOrder() {
        $this->doConnect();
        $stmt = $this->conn->prepare("");
        $stmt->execute();
        $this->closeConnect();
    }
    
    function setOfferOrder() {
        $this->doConnect();
        $stmt = $this->conn->prepare("");
        $stmt->execute();
        $this->closeConnect();
    }
    
    function getAvailableOffer($vendor) {
        
        $this->doConnect();
        
        $stmt = $this->conn->prepare("select ID from offer of left join order or on of.ID = or.OfferID where SupplierID = ? and or.ID = null");
        
        $stmt->bind_param("i", $vendor);
        
        $stmt->execute();
        
        $stmt->bind_result($id);
        
        if($stmt->fetch()){
            $id = $id;
        }
        
        $this->closeConnect();
        return $id;
    }

}
