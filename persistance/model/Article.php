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

    function Article($number, $desc, $group, $buyPrice, $unit, $packUnit, $packSize, $min, $surcharge) {
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
    
    function getArticleNumber(){
        return $this->articleNumber;
    }
    
    function setArticleDesc($desc) {
        $this->articleDesc = $desc;
    }
    
    function getArticleDesc() {
        return $this->articleDesc;
    }

    function setArticleGroup($group) {
        $this->articleGroup = $group;
    }
    
    function getArticleGroup() {
        
    }
}
