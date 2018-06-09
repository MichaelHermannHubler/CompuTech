<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/Article.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_purchase/ArticleGroupDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/AbstractDAO.php';

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

    function getArticlesByFilter($filter){
        $db = new ArticleGroupDAO;

        $this->doConnect();
        if ($filter != null){
            echo "filter:";
            echo $filter;

            $stmt = $this->conn->prepare("select Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, Surcharge, SupplierID from article where Name = ?");
            $stmt->bind_param("s", $filter);

        }else{
            echo "nofilter";
            $stmt = $this->conn->prepare("select Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, Surcharge, SupplierID from article");

        }





        $stmt->execute();

        $stmt->bind_result($articleNum, $articleDesc, $articleGroup, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $surcharge, $supplier);

        $articleArray = array();

        while ($stmt->fetch()) {
            $articleArrayEntry = array(new Article($articleNum, $articleDesc, $articleGroup, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $supplier, $surcharge));
            array_push($articleArray, $articleArrayEntry);

        }

        $this->closeConnect();

        return $articleArray;


    }
}
