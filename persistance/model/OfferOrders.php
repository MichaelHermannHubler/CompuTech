<?php

Class OfferOrders extends Voucher {

   

    function __construct($num, $party, $create, $total) {
        parent::__construct($num, $party, $create);
        
        
        
       
    }

    function setOffer($number, $vendorNumber, $create, $total) {
        $db = new SupplierDAO();
        $check = $db->getSupplier($vendorNumber);
        if ($check) {
            $this->vendorNumber = $vendorNumber;
        } else {
            echo "VendorNumber doesn't exist.";
        }
        $this->number = $number;
        $this->createDate = $create;
        $this->total = $total;

        $offerDB = new OfferOrderDAO;

        $id = $offerDB->setOfferOrder($number, $vendorNumber, $create, $total);
        
        
        return $id;
    }

    
    function getID(){
        return $this->num-1000;
    }

}
