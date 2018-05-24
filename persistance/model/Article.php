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

    function getArticleNumber() {
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
        return $this->articleGroup;
    }

    function setBuyingPrice($price) {
        $this->buyingPrice = $price;
    }

    function getBuyingPrice() {
        return $this->buyingPrice;
    }

    function getSellingPrice() {
        return $this->sellingPrice;
    }

    function setUnit($unit) {
        $this->unit = $unit;
    }

    function getUnit() {
        return $this->unit;
    }

    function setPackingUnit($packUnit) {
        $this->packingUnit = $packUnit;
    }

    function getPackingUnit() {
        return $this->packingUnit;
    }

    function setPackingSize($size) {
        $this->packingSize = $size;
    }

    function getPackingSize() {
        return $this->packingSize;
    }

    function setMinimumLevel($min) {
        $this->minimumStockLevel = $min;
    }

    function getMinimumLevel() {
        return $this->minimumStockLevel;
    }

    function setSurcharge($surcharge) {
        $this->surcharge = $surcharge;
    }

    function getSurcharge() {
        return $this->surcharge;
    }

}
