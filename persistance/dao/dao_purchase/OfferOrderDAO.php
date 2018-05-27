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

}
