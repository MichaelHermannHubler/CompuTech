<?php

Class OfferOrders {

    protected $number = 0;
    protected $vendorNumber = 0;
    protected $createDate;
    protected $articles = array();
    
    
    function __construct($num, $vendorNum, $create, $articles) {
        $this->number = $num;
        $this->vendorNumber = $vendorNum;
        $this->createDate = $create;
        $this->articles = $articles;
        
        //to do DB set
    }
    
    function getNum() {
        return $this->number;
    }
    
    function getVendor() {
        return $this->vendorNumber;
    }
    
    function getCreateDate() {
        return $this->createDate;
    }
    
    function setOffer($number, $vendorNumber, $create) {
        $this->number = $number;
        $this->vendorNumber = $vendorNumber;
        $this->createDate = $create;
        
        //todo DB set
    }

    function convertOfferToOrder($this) {
        
    }
    
    function insertArticleInOffer($article) {
        array_push($this->articles, $article);
    }
    
    function getArticles() {
        return $this->articles;
    }
}
