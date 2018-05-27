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
    private $vendor;
    private $surcharge = 0;

    function __construct($number, $desc, $group, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $min, $vendor, $surcharge) {
        $this->articleNumber = $number;
        $this->articleDesc = $desc;
        $this->articleGroup = $group;
        if ($buyPrice > 0) {
            $this->buyingPrice = $buyPrice;
        } else {
            echo "BuyingPrice should be higher than zero.";
        }
        if ($sellPrice > 0) {
            $this->sellingPrice = $sellPrice;
        } else if ($sellPrice == null) {
            $this->sellingPrice = $this->calcSellPrice($this->buyingPrice, $this->surcharge);
        } else {
            echo "SellingPrice should be higher than zero.";
        }
        $this->unit = $unit;
        $this->packingUnit = $packUnit;
        if ($packSize > 0) {
            $this->packingSize = $packSize;
        } else {
            echo "PackingSize should be higher than zero.";
        }
        $this->minimumStockLevel = $min;
        $this->vendor = $vendor;
        $this->surcharge = $surcharge;
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

    function setArticle($desc, $group, $buyPrice, $unit, $packUnit, $packSize, $minLevel, $vendor, $surcharge) {
        $this->articleDesc = $desc;
        $this->articleGroup = $group;
        if ($buyPrice > 0) {
            $this->buyingPrice = $buyPrice;
        } else {
            echo "BuyingPrice should be higher than zero.";
        }
        $this->unit = $unit;
        $this->packingUnit = $packUnit;
        if ($packSize > 0) {
            $this->packingSize = $packSize;
        } else {
            echo "PackingSize should be higher than zero.";
        }
        $this->minimumStockLevel = $minLevel;
        $this->vendor = $vendor;
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

    function getVendor() {
        return $this->vendor;
    }

    function getSurcharge() {
        return $this->surcharge;
    }

}
