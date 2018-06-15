<?php

include_once '../../model/Article.php';
include_once './ArticleGroupDAO.php';

Class ArticleDAO extends AbstractDAO {

    function __construct() {
        
    }

    function getArticle($num) {
        $this->doConnect();

        $stmt = $this->conn->prepare("select Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, Surcharge, SupplierID from article where ID = ?");

        $stmt->bind_param("i", $num);

        $stmt->execute();

        $stmt->bind_result($articleNum, $articleDesc, $articleGroup, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $surcharge, $supplier);

        if ($stmt->fetch()) {
            $db = new ArticleGroupDAO;
            $articleGroupName = $db->getArtikelGroupName($articleGroup);
            $article = new Article($articleNum, $articleDesc, $articleGroupName, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $supplier, $surcharge);
        }

        $this->closeConnect();

        return $article;
    }

    function setArticle($num, $desc, $group, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minStockLevel, $surcharge, $supplier) {
        $this->doConnect();

        $db = new ArticleGroupDAO;

        $artikelGroupID = $db->getArtikelGroupID($group);

        if ($num == null) {
            $stmt = $this->conn->prepare("insert into articles (Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, Surcharge, SupplierID) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("siiissiiii", $desc, $artikelGroupID, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minStockLevel, $surcharge, $supplier);
        } else {
            $stmt = $this->conn->prepare("update articles set Name = ?, ArticleGroupID = ?, PurchasePrice = ?, RetailPrice = ?, Unit = ?, PackingType = ?, PackingQuantity = ?, MinimalStorage = ?, Surcharge = ?, SupplierID = ? where ID = ?");
            $stmt->bind_param("siiissiiiii", $desc, $artikelGroupID, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minStockLevel, $surcharge, $supplier, $num);
        }

        $stmt->execute();

        if ($num == null && $stmt->fetch()) {
            $id = mysqli_insert_id($stmt);
        }
        $this->closeConnect();
        return $id;
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

        $stmt = $this->conn->prepare("select Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, Surcharge, SupplierID from article");

        $stmt->execute();

        $stmt->bind_result($num, $name, $articleGroup, $buyPice, $sellPrice, $unit, $packUnit, $packSize, $min, $surcharge, $vendor);

        while ($stmt->fetch()) {
            $db = new ArticleGroupDAO;
            $articleGroupName = $db->getArtikelGroupName($articleGroup);
            $artikel = new Article($num, $name, $articleGroupName, $buyPice, $sellPrice, $unit, $packUnit, $packSize, $min, $vendor, $surcharge);
            array_push($artikelStock, $artikel);
        }

        $this->closeConnect();

        return $artikelStock;
    }

    function getWarehouseLocationArticles($articleID)
    {
        $this->doConnect();
        $stmt = $this->conn->prepare("SELECT WarehouseLocationID, QuantityStored from warehouselocationarticle where ArticleID = ?");
        $stmt->bind_param("i", $articleID);

        $stmt->execute();

        $warehouseLocationId = 0;
        $quantity = 0;
        $stmt->bind_result($warehouseLocationId, $quantity);

        $warehouseArray = array();

        while($stmt->fetch())
        {
            $warehouseLocationGetter = new WarehouseLocationDAO();
            $warehouseLocation = $warehouseLocationGetter->getWarehouseLocation($warehouseLocationId);

            $warehouseArrayEntry = array($warehouseLocation, $quantity);

            array_push($warehouseArray, $warehouseArrayEntry);
        }

        $this->closeConnect();
        return $warehouseArray;
    }

}
