<?php

include_once  $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_purchase/ArticleDAO.php';

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

        if ($this->articleNumber == null) {
            $db = new ArticleDAO;

            $this->articleNumber = $db->setArticle($this->articleNumber, $this->articleDesc, $this->articleGroup, $this->buyingPrice, $this->sellingPrice, $this->sellingPrice, $this->unit, $this->packingUnit, $this->packingSize, $this->minimumStockLevel, $this->surcharge);
        }
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

    function setArticle($desc, $group, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minLevel, $vendor, $surcharge) {
        $this->articleDesc = $desc;
        $this->articleGroup = $group;
        if ($buyPrice > 0) {
            $this->buyingPrice = $buyPrice;
        } else {
            echo "BuyingPrice should be higher than zero.";
        }
        if ($sellPrice > 0) {
            $this->sellingPrice = $sellPrice;
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
        $this->minimumStockLevel = $minLevel;
        $this->vendor = $vendor;
        $this->surcharge = $surcharge;

        $db = new ArticleDAO;
        if ($this->articleNumber == null) {
            $this->articleNumber = $db->setArticle($this->articleNumber, $this->articleDesc, $this->articleGroup, $this->buyingPrice, $this->sellingPrice, $this->unit, $this->packingUnit, $this->packingSize, $this->minimumStockLevel, $this->surcharge, $this->vendor);
        } else {
            $db->setArticle($this->articleNumber, $this->articleDesc, $this->articleGroup, $this->buyingPrice, $this->sellingPrice, $this->unit, $this->packingUnit, $this->packingSize, $this->minimumStockLevel, $this->surcharge, $this->vendor);
        }
    }

    /**
     * @return int|string
     */
    public function getArticleNumber()
    {
        return $this->articleNumber;
    }

    /**
     * @param int|string $articleNumber
     */
    public function setArticleNumber($articleNumber)
    {
        $this->articleNumber = $articleNumber;
    }

    /**
     * @return string
     */
    public function getArticleDesc()
    {
        return $this->articleDesc;
    }

    /**
     * @param string $articleDesc
     */
    public function setArticleDesc($articleDesc)
    {
        $this->articleDesc = $articleDesc;
    }

    /**
     * @return int
     */
    public function getArticleGroup()
    {
        return $this->articleGroup;
    }

    /**
     * @param int $articleGroup
     */
    public function setArticleGroup($articleGroup)
    {
        $this->articleGroup = $articleGroup;
    }

    /**
     * @return int
     */
    public function getBuyingPrice()
    {
        return $this->buyingPrice;
    }

    /**
     * @param int $buyingPrice
     */
    public function setBuyingPrice($buyingPrice)
    {
        $this->buyingPrice = $buyingPrice;
    }

    /**
     * @return float|int
     */
    public function getSellingPrice()
    {
        return $this->sellingPrice;
    }

    /**
     * @param float|int $sellingPrice
     */
    public function setSellingPrice($sellingPrice)
    {
        $this->sellingPrice = $sellingPrice;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return string
     */
    public function getPackingUnit()
    {
        return $this->packingUnit;
    }

    /**
     * @param string $packingUnit
     */
    public function setPackingUnit($packingUnit)
    {
        $this->packingUnit = $packingUnit;
    }

    /**
     * @return int
     */
    public function getPackingSize()
    {
        return $this->packingSize;
    }

    /**
     * @param int $packingSize
     */
    public function setPackingSize($packingSize)
    {
        $this->packingSize = $packingSize;
    }

    /**
     * @return int
     */
    public function getMinimumStockLevel()
    {
        return $this->minimumStockLevel;
    }

    /**
     * @param int $minimumStockLevel
     */
    public function setMinimumStockLevel($minimumStockLevel)
    {
        $this->minimumStockLevel = $minimumStockLevel;
    }

    /**
     * @return mixed
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param mixed $vendor
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * @return int
     */
    public function getSurcharge()
    {
        return $this->surcharge;
    }

    /**
     * @param int $surcharge
     */
    public function setSurcharge($surcharge)
    {
        $this->surcharge = $surcharge;
    }



}
