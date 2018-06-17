<?php

Class OfferOrders extends Voucher {

    private $total = 0;

    function __construct($num, $party, $create, $total) {
        parent::__construct($num, $party, $create);
        $this->total = $total;
        
        
       
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

    function getTotal() {
        return $this->total;
    }
    
    function getID(){
        return $this->num-1000;
    }

}
