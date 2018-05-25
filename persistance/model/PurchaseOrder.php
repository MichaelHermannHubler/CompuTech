<?php

Class PurchaseOrder extends Voucher {
    
    private $orderDate;
    private $offerNumber = null;
    private $ordered = false;

    
    function __construct($num, $party, $createDate, $articles, $offerNum) {
        parent::__construct($num, $party, $createDate, $articles);
        $this->offerNumber = $offerNum;
    }
    
    function setOrder($party, $createDate, $articles, $offerNum) {
        $this->party = $party;
        $this->createDate = $createDate;
        $this->articles = $articles;
        $this->offerNumber = $offerNum;
        
        //to do DB set
    }

    function getOrderDate() {
        return $this->orderDate;
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
