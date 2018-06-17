<?php

Class PurchaseOrderArticle {

    private $articleId;
    private $orderId;
    private $quantityOrdered;
    private $quantityDelivered;
    private $price;
    private $defective;

    function __construct($articleId, $orderId, $quantityOrdered, $quantityDelivered, $price, $defective) {
        $this->articleId = $articleId;
        $this->orderId = $orderId;
        $this->quantityOrdered = $quantityOrdered;
        $this->quantityDelivered = $quantityDelivered;
        $this->price = $price;
        $this->defective = $defective;
    }

    function getArticleId() {
        return $this->articleId;
    }

    function getOrderId() {
        return $this->orderId;
    }

    function getQuantityOrdered() {
        return $this->quantityOrdered;
    }

    function getQuantityDelivered() {
        return $this->quantityDelivered;
    }
    
    function getPrice() {
        return $this->price;
    }
    
    function getDefective() {
        return $this->defective;
    }
}