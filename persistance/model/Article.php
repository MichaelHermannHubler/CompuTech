<?php

Class Article {

    private $articleNumber = null;
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
    private $delete = 0;

    function __construct($number, $desc, $group, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $min, $vendor, $surcharge, $delete) {
        $db = new ArticleDAO;

        if ($number == null) {
            $num = ($db->getHighestID()) + 1;
            $this->articleNumber = 10000 + $num;
        } else {
            $this->articleNumber = $number;
        }

        $this->articleDesc = $desc;
        $this->articleGroup = $group;
        $this->buyingPrice = $buyPrice;

        if ($sellPrice > 0) {
            $this->sellingPrice = $sellPrice;
        } else{
            $this->sellingPrice = $this->calcSellPrice($this->buyingPrice, $this->surcharge);
        }
        $this->unit = $unit;
        $this->packingUnit = $packUnit;
        $this->packingSize = $packSize;

        $this->delete = $delete;

        $this->minimumStockLevel = $min;
        $this->vendor = $vendor;
        $this->surcharge = $surcharge;


        $db->setArticle($this->articleNumber, $this->articleDesc, $this->articleGroup, $this->buyingPrice, $this->sellingPrice, $this->unit, $this->packingUnit, $this->packingSize, $this->minimumStockLevel, $this->surcharge, $this->vendor, $this->delete);
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

    function setArticle($desc, $group, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minLevel, $vendor, $surcharge, $delete) {


        $this->articleDesc = $desc;
        $this->articleGroup = $group;
        $this->buyingPrice = $buyPrice;
        $this->sellingPrice = $sellPrice;

        $this->unit = $unit;
        $this->packingUnit = $packUnit;
        $this->packingSize = $packSize;
        $this->minimumStockLevel = $minLevel;
        $this->vendor = $vendor;
        $this->surcharge = $surcharge;

        $this->delete = $delete;

        $db = new ArticleDAO;

        $db->setArticle($this->articleNumber, $this->articleDesc, $this->articleGroup, $this->buyingPrice, $this->sellingPrice, $this->unit, $this->packingUnit, $this->packingSize, $this->minimumStockLevel, $this->surcharge, $this->vendor, $this->delete);
    }

    function getID() {
        if ($this->articleNumber != null) {
            return $this->articleNumber - 10000;
        }
    }

    /**
     * @return int|string
     */
    public function getArticleNumber() {
        return $this->articleNumber;
    }

    /**
     * @return string
     */
    public function getArticleDesc() {
        return $this->articleDesc;
    }

    /**
     * @return int
     */
    public function getArticleGroup() {
        return $this->articleGroup;
    }

    /**
     * @return int
     */
    public function getBuyingPrice() {
        return $this->buyingPrice;
    }

    /**
     * @return float|int
     */
    public function getSellingPrice() {
        return $this->sellingPrice;
    }

    /**
     * @return string
     */
    public function getUnit() {
        return $this->unit;
    }

    function getPackingUnit() {
        if ($this->packingUnit == null) {
            return "NA";
        }
        return $this->packingUnit;
    }

    function getPackingSize() {
        if ($this->packingSize == null) {
            return "NA";
        }
        return $this->packingSize;
    }

    /**
     * @return int
     */
    public function getMinimumStockLevel() {
        return $this->minimumStockLevel;
    }

    /**
     * @return mixed
     */
    public function getVendor() {
        return $this->vendor;
    }

    /**
     * @return int
     */
    public function getSurcharge() {
        return $this->surcharge;
    }

    public function getDelete() {
        return $this->delete;
    }

}
