<?php

Class Article {

    private $articleNumber = 0;
    private $articleDesc = "";
    private $articleGroup = 0;
    private $buyingPrice = 0;
    private $sellingPrice = 0;
    private $unit = "";
    private $packingUnit = "";
    private $packingSize = 0;
    private $minimumStockLevel = 0;
    private $surcharge = 0;
    
    function __construct($number, $desc, $group, $buyPrice, $unit, $packUnit, $packSize, $min, $surcharge) {
        $this->articleNumber = $number;
        $this->articleDesc = $desc;
        $this->articleGroup = $group;
        $this->buyingPrice = $buyPrice;
        $this->unit = $unit;
        $this->packingUnit = $packUnit;
        $this->packingSize = $packSize;
        $this->minimumStockLevel = $min;
        $this->surcharge = $surcharge;
        $this->sellingPrice = $this->calcSellPrice($this->buyingPrice, $this->surcharge);
    }

   
    private function calcSellPrice($buyPrice, $surcharge) {
        $sell = 0;

        if ($surcharge != 0) {
            $sell = $buyPrice * (1 + ($surcharge / 100));
        } else {
            $sell = $buyPrice;
        }

        return $sell;
    }
    
    function setArticle($desc, $group, $buyPrice, $unit, $packUnit, $packSize, $minLevel, $surcharge) {
        $this->articleDesc = $desc;
        $this->articleGroup = $group;
        $this->buyingPrice = $buyPrice;
        $this->unit = $unit;
        $this->packingUnit = $packUnit;
        $this->packingSize = $packSize;
        $this->minimumStockLevel = $minLevel;
        $this->surcharge = $surcharge;
        
        //to do Datenbank set
    }

    function getArticleNumber() {
        return $this->articleNumber;
    }


    function getArticleDesc() {
        return $this->articleDesc;
    }

    function getArticleGroup() {
        return $this->articleGroup;
    }

    function getBuyingPrice() {
        return $this->buyingPrice;
    }

    function getSellingPrice() {
        return $this->sellingPrice;
    }

    function getUnit() {
        return $this->unit;
    }

    function getPackingUnit() {
        return $this->packingUnit;
    }

    function getPackingSize() {
        return $this->packingSize;
    }

    function getMinimumLevel() {
        return $this->minimumStockLevel;
    }

    function getSurcharge() {
        return $this->surcharge;
    }

}
