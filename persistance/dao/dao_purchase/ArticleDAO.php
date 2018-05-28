<?php

include '../../model/Article.php';

Class ArticleDAO extends AbstractDAO {

    function __construct() {
        
    }

    function getArticle($num) {
        $this->doConnect();

        $stmt = $this->conn->prepare("select articleNumber, articleDesc, articleGroup, buyingPrice, sellingPrice, unit, packingUnit, packingSize, minimumStockLevel, surcharge from article where articlenumber = ?");

        $stmt->bind_param("i", $num);

        $stmt->execute();

        $stmt->bind_result($articleNum, $articleDesc, $articleGroup, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $surcharge);

        if ($stmt->fetch()) {
            $db = new ArticleGroupDAO;
            $articleGroupName = $db->getArtikelGroupName($articleGroup);
            $article = new Article($articleNum, $articleDesc, $articleGroupName, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $surcharge);
        }

        $this->closeConnect();

        return $article;
    }

    function setArticle($num, $desc, $group, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minStockLevel, $surcharge) {
        $this->doConnect();
        
        $db = new ArticleGroupDAO;
                
        $artikelGroupID = $db->getArtikelGroupID($group);

        if ($num == null) {
            $stmt = $this->conn->prepare("insert into articles (desc, group, buyPrice, sellPrice, unit, packUnit, packSize, minStocklevel, surcharge) values ($desc, $artikelGroupID, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minStockLevel, $surcharge)");
        } else {
            $stmt = $this->conn->prepare("update articles set desc = $desc, group = $artikelGroupID, buyPrice = $buyPrice, sellPrice = $sellPrice, unit = $unit, packUnit = $packUnit, packSize = $packSize, minStockLevel = $minStockLevel, surcharge = $surcharge where articleNumber = ?");
            $stmt->bind_param("i", $num);
        }

        $stmt->execute();

        $this->closeConnect();
    }

    function getVendor($articleNum) {
        $this->doConnect();

        $stmt = $this->conn->prepare("select SupplierID from article where Number = ?");

        $stmt->bind_param("i", $articleNum);

        $stmt->execute();

        $stmt->bind_result($vendor);

        if ($stmt->fetch()) {
            $vendor = $vendor;
        }

        $this->closeConnect();
        return $vendor;
    }

    function getStockList() {
        $this->doConnect();

        $artikelStock = array();

        $stmt = $this->conn->prepare("select number, Name, MinimalStorage, PurchasePrice, SupplierID, RetailPrice, Surchage, ArticleGroupID, Unit, PackingType, PackingQuantity from article");

        $stmt->execute();

        $stmt->bind_result($num, $name, $min, $buyPice, $vendor, $sellPrice, $surcharge, $articleGroup, $unit, $packingType, $packingQuant);

        while ($stmt->fetch()) {
            $db = new ArticleGroupDAO;
            $articleGroupName = $db->getArtikelGroupName($articleGroup);
            $artikel = new Article($num, $name, $articleGroupName, $buyPice, $sellPrice, $unit, $packingType, $packingQuant, $min, $vendor, $surcharge);
            array_push($artikelStock, $artikel);
        }

        $this->closeConnect();

        return $artikelStock;
    }

}
