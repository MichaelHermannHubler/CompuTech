<?php


Class ArticleDAO extends AbstractDAO
{

    function __construct()
    {

    }

    function getArticle($num)
    {
        $this->doConnect();

        $stmt = $this->conn->prepare("select Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, Surcharge, SupplierID, ReservedStock from article where ID = ?");

        $stmt->bind_param("i", $num);

        $stmt->execute();

        $stmt->bind_result($articleNum, $articleDesc, $articleGroup, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $surcharge, $supplier, $reservedStock);

        if ($stmt->fetch()) {
            $db = new ArticleGroupDAO;
            $articleGroupName = $db->getArtikelGroupName($articleGroup);
            $article = new Article($articleNum, $articleDesc, $articleGroupName, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $supplier, $surcharge, $reservedStock);
        }

        $this->closeConnect();

        return $article;
    }

    function reduceAvailability($articleID, $amount)
    {

        $this->doConnect();

        $stmt = $this->conn->prepare("UPDATE ARTICLE SET Number = (SELECT NUMBER FROM ARTICLE WHERE ID = i) - i WHERE ID = i");

        $stmt->bind_param("iii", $articleID, $amount, $articleID);

        $stmt->execute();

        $stmt->bind_result($articleNum, $articleDesc, $articleGroup, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $surcharge, $supplier, $reservedStock);

        if ($stmt->fetch()) {
            $db = new ArticleGroupDAO;
            $articleGroupName = $db->getArtikelGroupName($articleGroup);

            $article = new Article($articleNum, $articleDesc, $articleGroupName, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $supplier, $surcharge, $reservedStock);
        }
        $this->closeConnect();

        return $article;
    }

    function setArticle($num, $desc, $group, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minStockLevel, $surcharge, $supplier, $reservedStock)
    {
        $this->doConnect();

        $db = new ArticleGroupDAO;

        $artikelGroupID = $db->getArtikelGroupID($group);

        $vendDB = new SupplierDAO;
        if (!$this->checkNumber($num)) {
            $vendID = $vendDB->getSupplierIDByName($supplier);
        } else {
            $vendID = $supplier;
        }

        if (!$this->checkNumber($num)) {
            $link = $this->doConnect();
            $query = "INSERT into article (Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, SupplierID, Surcharge, $reservedStock) values ('$num','$desc',$artikelGroupID,$buyPrice,$sellPrice,'$unit','$packUnit',$packSize,$minStockLevel,$vendID,$surcharge, $reservedStock)";
            mysqli_query($this->conn, $query);
        } else {
            $link = $this->doConnect();
            $query = "update article set Name = '$desc', ArticleGroupID = $artikelGroupID, PurchasePrice = $buyPrice, RetailPrice = $sellPrice, Unit = '$unit', PackingType = '$packUnit', PackingQuantity = $packSize, MinimalStorage = $minStockLevel, SupplierID = $vendID, Surcharge = $surcharge,  ReservedStock=$reservedStock where Number = '$num'";
            mysqli_query($this->conn, $query);
        }
        $this->closeConnect();
    }

    function checkNumber($num)
    {
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

    function getVendor($articleNum)
    {
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

    function getStockList()
    {
        $this->doConnect();

        $artikelStock = array();

        $stmt = $this->conn->prepare("select Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage,SupplierID, Surcharge, ReservedStock from article");

        $stmt->execute();

        $stmt->bind_result($num, $name, $articleGroup, $buyPice, $sellPrice, $unit, $packUnit, $packSize, $min, $vendor, $surcharge, $reservedStock);

        while ($stmt->fetch()) {
            $db = new ArticleGroupDAO;
            $articleGroupName = $db->getArtikelGroupName($articleGroup);
            $artikel = new Article($num, $name, $articleGroupName, $buyPice, $sellPrice, $unit, $packUnit, $packSize, $min, $vendor, $surcharge, $reservedStock);
            array_push($artikelStock, $artikel);
        }

        $this->closeConnect();

        return $artikelStock;
    }

    function getHighestID()
    {
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

    function getArticleFromSupplier($supplierID)
    {
        $this->doConnect();

        $stmt = $this->conn->prepare("select Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, Surcharge, SupplierID, ReservedStockfrom article where SupplierID = ?");

        $stmt->bind_param("i", $supplierID);

        $stmt->execute();

        $stmt->bind_result($articleNum, $articleDesc, $articleGroup, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $surcharge, $supplier, $reservedStock);

        $db = new ArticleGroupDAO;

        $supplierArticles = array();

        while ($stmt->fetch()) {

            $articleGroupName = $db->getArtikelGroupName($articleGroup);

            $article = new Article($articleNum, $articleDesc, $articleGroupName, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $supplier, $surcharge, $reservedStock);
            array_push($supplierArticles, $article);
        }
        $this->closeConnect();

        return $supplierArticles;
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

        while ($stmt->fetch()) {
            $warehouseLocationGetter = new WarehouseLocationDAO();
            $warehouseLocation = $warehouseLocationGetter->getWarehouseLocation($warehouseLocationId);

            $warehouseArrayEntry = array($warehouseLocation, $quantity);

            array_push($warehouseArray, $warehouseArrayEntry);
        }

        $this->closeConnect();
        return $warehouseArray;
    }

    function getArticlesByFilter($filter)
    {
        $db = new ArticleGroupDAO;

        $this->doConnect();
        if ($filter != null) {
            echo "filter:";
            echo $filter;

            $stmt = $this->conn->prepare("select Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, Surcharge, SupplierID, ReservedStock from article where Name = ? AND ReservedStock >0");
            $stmt->bind_param("s", $filter);

        } else {
            echo "nofilter";
            $stmt = $this->conn->prepare("select Number, Name, ArticleGroupID, PurchasePrice, RetailPrice, Unit, PackingType, PackingQuantity, MinimalStorage, Surcharge, SupplierID, ReservedStock from article WHERE ReservedStock > 0");

        }


        $stmt->execute();

        $stmt->bind_result($articleNum, $articleDesc, $articleGroup, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $surcharge, $supplier, $reservedStock);

        $articleArray = array();

        while ($stmt->fetch()) {
            $articleArrayEntry = array(new Article($articleNum, $articleDesc, $articleGroup, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $supplier, $surcharge, $reservedStock));
            array_push($articleArray, $articleArrayEntry);

        }

        $this->closeConnect();

        return $articleArray;


    }

    function reduceAvaiabilityByNumber($articleID, $amount)
    {
        $this->doConnect();


        $stmt = $this->conn->prepare("UPDATE article SET `ReservedStock`= (SELECT `ReservedStock` WHERE `ID` = ?) - ? WHERE `ID` = ?");
        $stmt->bind_param("iii", $articleID,$amount,$articleID);


        $stmt->execute();


        $this->closeConnect();


    }
}
