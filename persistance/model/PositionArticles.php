<?php

Class PositionArticles{
    private $articleNumber;
    private $price;
    private $quantity;
    
    function __construct($num, $price, $quantity) {
        $this->articleNumber = $num;
        $this->price = $price;
        $this->quantity = $quantity;
    }
    
    function getArticleNumber() {
        return $this->articleNumber;
    }
    
    function getPrice() {
        return $this->price;
    }
    
    function getQuantity() {
        return $this->quantity;
    }
    
    function setPositionArticles($price, $quantity) {
        $this->price = $price;
        $this->quantity = $quantity;
        
        //to do DB set
    }
}

