<?php

Class PurchaseOrder extends Voucher {
    
    private $orderDate;
    private $offerNumber = null;
    private $orderStatus;
    private $deliveryType;
                
    function __construct($num, $party, $createDate, $articles, $offerNum, $orderDate, $orderStatus, $deliveryType) {
        parent::__construct($num, $party, $createDate, $articles);
        $this->offerNumber = $offerNum;
        $this->orderDate = $orderDate;
        $this->deliveryType = $deliveryType;
        $this->orderStatus = $orderStatus;
    }
    
    function setOrder($party, $createDate, $articles, $offerNum, $orderStatus, $deliveryType) {
        $this->party = $party;
        $this->createDate = $createDate;
        $this->articles = $articles;
        $this->offerNumber = $offerNum;
        $this->orderStatus = $orderStatus;
        $this->deliveryType = $deliveryType;
        
        //to do DB set
    }

    function getOrderDate() {
        return $this->orderDate;
    }
    
    
    function getOfferNumber() {
        return $this->offerNumber;
    }
    
    function order() {
        $this->orderDate = new Date('Y-m-d h:i:s');
    }
    
    function getOrderStatus() {
        return $this->orderStatus;
    }
    
    function getDeliveryType() {
        return $this->deliveryType;
    }
    
}
