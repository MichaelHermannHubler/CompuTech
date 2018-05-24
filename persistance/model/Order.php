<?php

Class Order extends OfferOrders {
    
    private $orderDate;
    private $offerNumber = null;
    private $ordered = false;

    function __construct($orderNum, $vendorNum, $create, $offerNum, $articles) {
        parent::__construct($orderNum, $vendorNum, $create, $articles);
        $this->offerNumber = $offerNum;
    }

    function getOrderDate() {
        return $this->orderDate;
    }
    
    function getVendor() {
        parent::getVendor();
    }
   
    function getNum() {
        parent::getNum();
    }
    
    function getCreateDate() {
        parent::getCreateDate();
    }
    
    function getOfferNumber() {
        return $this->offerNumber;
    }
    
    function order($actualDate) {
        $this->ordered = true;
        $this->setOrderDate($actualDate);
    }
    
    private function setOrderDate($date) {
        $this->orderDate = $date;
    }
    
}
