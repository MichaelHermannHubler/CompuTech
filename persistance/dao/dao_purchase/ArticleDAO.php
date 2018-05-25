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
        
        if($stmt->fetch()){
            $article = new Article($articleNum, $articleDesc, $articleGroup, $buyingPrice, $sellingPrice, $unit, $packingUnit, $packingSize, $minimumStockLevel, $surcharge);

        }

        $this->closeConnect();
        
        return $article;
    }

    function setArticle($num, $desc, $group, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minStockLevel, $surcharge) {
        $this->doConnect();

        if($num == null){
            $stmt = $this->conn->prepare("insert into articles (desc, group, buyPrice, sellPrice, unit, packUnit, packSize, minStocklevel, surcharge) values ($desc, $group, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $minStockLevel, $surcharge)");
        }else{
            $stmt = $this->conn->prepare("update articles set desc = $desc, group = $group, buyPrice = $buyPrice, sellPrice = $sellPrice, unit = $unit, packUnit = $packUnit, packSize = $packSize, minStockLevel = $minStockLevel, surcharge = $surcharge where articleNumber = ?");
                    $stmt->bind_param("i", $num);
        }

        $stmt->execute();

        $this->closeConnect();
    }

}
