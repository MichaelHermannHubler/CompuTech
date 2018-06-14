<?php

require_once '../../persistance/dao/AbstractDAO.php';

Class ArticleDAO extends AbstractDAO {

    function __construct() {
        
    }

    function getArticle($num) {
        $this->doConnect();

        $stmt = $this->conn->prepare("select Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, Surcharge, SupplierID from article where Number = ?");

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

        $group = utf8_encode($group);
        $artikelGroupID = $db->getArtikelGroupID($group);

        $vendDB = new SupplierDAO;
        if ($this->checkNumber($num) == null) {
            $vendID = $vendDB->getSupplierIDByName($supplier);
        } else {
            $vendID = $supplier;
        }


        if ($this->checkNumber($num) == null) {
            $link = $this->doConnect();
            $query = "INSERT into article (Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, SupplierID, Surcharge) values ('$num','$desc',$artikelGroupID,$buyPrice,$sellPrice,'$unit','$packUnit',$packSize,$minStockLevel,$vendID,$surcharge)";
            mysqli_query($this->conn, $query);
            //$stmt = $this->conn->prepare("INSERT into article (Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, SupplierID, Surcharge) values ('$num','$desc',$artikelGroupID,$buyPrice,$sellPrice,'$unit','$packUnit',$packSize,$minStockLevel,$vendID,$surcharge)");
            //$stmt = $this->conn->prepare("INSERT into article (Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, SupplierID, Surcharge) values (?,?,?,?,?,?,?,?,?,?,?)");        
            //$stmt->bind_param("ssiddssiiid", $num, $desc, $artikelGroupID, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minStockLevel, $vendID, $surcharge);
            //$stmt = $this->conn->prepare("insert into article (Number, Name, MinimalStorage, PurchasePrice, RetailPrice, SupplierID, Surcharge, ArticleGroupID, Unit, PackingType, PackingQuantity) values( '$num', '$desc',$minStockLevel, $buyPrice, $sellPrice, $vendID, $surcharge, $artikelGroupID, '$unit', '$packUnit', $packSize)");
            //echo $stmt;
            //$stmt = $this->conn->prepare("insert into article (Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, SupplierID, Surcharge) values ($num,'$desc', $artikelGroupID, '$buyPrice', '$sellPrice', '$unit', '$packUnit', '$packSize', '$minStockLevel', $vendID, $surcharge)");        
            // $stmt->execute();
        } else {
            $link = $this->doConnect();
            $query = "update article set Name = '$desc', ArticleGroupID = $artikelGroupID, PurchasePrice = $buyPrice, RetailPrice = $sellPrice, Unit = '$unit', PackingType = '$packUnit', PackingQuantity = $packSize, MinimalStorage = $minStockLevel, SupplierID = $vendID, Surcharge = $surcharge where Number = '$num'";
            mysqli_query($this->conn, $query);
            /*  $stmt = $this->conn->prepare("update articles set Name = ?, ArticleGroupID = ?, PurchasePrice = ?, RetailPrice = ?, Unit = ?, PackingType = ?, PackingQuantity = ?, MinimalStorage = ?, SupplierID = ?, Surcharge = ? where Number = ?");
              $stmt->bind_param("siddssiidis", $desc, $artikelGroupID, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minStockLevel, $vendID, $surcharge, $num);
              $stmt->execute(); */
        }
        /*
          if ($num == null) {
          $stmt = $this->conn->prepare("insert into articles (Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, Surcharge, SupplierID) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("siiissiiii", $desc, $artikelGroupID, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minStockLevel, $surcharge, $vendID);
          } else {
          $stmt = $this->conn->prepare("update articles set Name = ?, ArticleGroupID = ?, PurchasePrice = ?, RetailPrice = ?, Unit = ?, PackingType = ?, PackingQuantity = ?, MinimalStorage = ?, Surcharge = ?, SupplierID = ? where Number = ?");
          $stmt->bind_param("siiissiiiii", $desc, $artikelGroupID, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minStockLevel, $surcharge, $vendID, $num);
          }
         */

        /*
          if ($num == null && $stmt->fetch()) {
          $id = mysqli_insert_id($stmt);
          } */
        $this->closeConnect();
        //   return $id;
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

        $stmt = $this->conn->prepare("select Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage,SupplierID, Surcharge from article");

        $stmt->execute();

        $stmt->bind_result($num, $name, $articleGroup, $buyPice, $sellPrice, $unit, $packUnit, $packSize, $min, $vendor, $surcharge);

        while ($stmt->fetch()) {
            $db = new ArticleGroupDAO;
            $articleGroupName = $db->getArtikelGroupName($articleGroup);
            $artikel = new Article($num, $name, $articleGroupName, $buyPice, $sellPrice, $unit, $packUnit, $packSize, $min, $vendor, $surcharge);
            array_push($artikelStock, $artikel);
        }

        $this->closeConnect();

        return $artikelStock;
    }

    function getHighestID() {
        $this->doConnect();

        $stmt = $this->conn->prepare("select ID from article order by ID desc LIMIT 1");

        $stmt->execute();

        $stmt->bind_result($id);

        if ($stmt->fetch()) {
            $id = $id;
        }

        $this->closeConnect();
        return $id;
    }

    function checkNumber($num) {
        $exist = false;
        $this->doConnect();

        $stmt = $this->conn->prepare("select ID from article where Number = ?");

        $stmt->bind_param("s", $num);

        $stmt->execute();


        if ($stmt->fetch()) {
            $exist = true;
        }

        $this->closeConnect();
        return $exist;
    }

    
        function getArticleFromSupplier($supplierID) {
        $this->doConnect();

        $stmt = $this->conn->prepare("select Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, Surcharge, SupplierID from article where SupplierID = ?");

        $stmt->bind_param("i", $supplierID);

        $stmt->execute();

        $stmt->bind_result($articleNum, $articleDesc, $articleGroup, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $surcharge, $supplier);

        $db = new ArticleGroupDAO;
        
        $supplierArticles = array();
        
        while ($stmt->fetch()) {
            
            $articleGroupName = $db->getArtikelGroupName($articleGroup);

            $article = new Article($articleNum, $articleDesc, $articleGroupName, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $supplier, $surcharge);
            array_push($supplierArticles, $article);
        }
        $this->closeConnect();

        return $supplierArticles;
    }
    
    
    
    
    
}
