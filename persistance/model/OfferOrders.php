<?php

Class OfferOrders extends Voucher{
   

    
    function __construct($num, $party, $create, $articles) {
        parent::__construct($num, $party, $create, $articles);
    }


    
    function setOffer($number, $vendorNumber, $create) {
        $this->number = $number;
        $this->vendorNumber = $vendorNumber;
        $this->createDate = $create;
        
        //todo DB set
    }

    function convertOfferToOrder($this) {
        
    }
    

}
