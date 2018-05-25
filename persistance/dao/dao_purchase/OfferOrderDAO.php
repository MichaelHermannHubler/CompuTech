<?php

Class OfferOrderDAO extends AbstractDAO {

    function __construct() {
        
    }
    
    function getOfferOrder() {
        $this->doConnect();
        
        $this->closeConnect();
    }
    
    function setOfferOrder() {
        $this->doConnect();
        
        $this->closeConnect();
    }

}
