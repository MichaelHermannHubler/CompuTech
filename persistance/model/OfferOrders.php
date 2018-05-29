<?php
include '../dao/dao_purchase/SupplierDAO.php';
Class OfferOrders extends Voucher{
   

    
    function __construct($num, $party, $create) {
        parent::__construct($num, $party, $create);
    }


    
    function setOffer($number, $vendorNumber, $create) {
        $db = new SupplierDAO();
        $check = $db->getSupplier($vendorNumber);
        if($check){
            $this->vendorNumber = $vendorNumber;
        }else{
            echo "VendorNumber doesn't exist.";
        }            
        $this->number = $number;        
        $this->createDate = $create;
        
        //todo DB set
    }

    function convertOfferToOrder($this) {
        
    }
    

}
