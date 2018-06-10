<?php
//include '../../model/WarehouseLocation.php';
//include '../dao_purchase/ArticleDAO.php';

Class WarehouseLocationDAO extends AbstractDAO
{

    function __construct() { }

    function getWarehouseLocation($id)
    {
        $this->doConnect();
        $stmt = $this->conn->prepare("SELECT Rack, Position from warehouselocation where ID = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();

        $rack = "";
        $position = "";
        $stmt->bind_result($rack, $position);

        if($stmt->fetch())
        {
            $warehouseLocation = new WarehouseLocation($id, $rack, $position);
        }

        $this->closeConnect();
        return $warehouseLocation;
    }

    function getWarehouseLocations()
    {
        $this->doConnect();
        $stmt = $this->conn->prepare("SELECT Id, Rack, Position from warehouselocation");

        $stmt->execute();

        $id = 0;
        $rack = "";
        $position = "";
        $stmt->bind_result($id, $rack, $position);

        $warehouseLocations = array();

        while($stmt->fetch())
        {
            $warehouseLocation = new WarehouseLocation($id, $rack, $position);

            array_push($warehouseLocations, $warehouseLocation);
        }

        $this->closeConnect();
        return $warehouseLocations;
    }

    function getWarehouseLocationArticles($warehouseLocationId)
    {
        $this->doConnect();
        $stmt = $this->conn->prepare("SELECT ArticleID, QuantityStored from warehouselocationarticle where warehouseLocationID = ?");
        $stmt->bind_param("i", $warehouseLocationId);

        $stmt->execute();

        $articleID = 0;
        $quantity = 0;
        $stmt->bind_result($articleID, $quantity);

        $articleArray = array();

        while($stmt->fetch())
        {
            $articleGetter = new ArticleDAO();
            $article = $articleGetter->getArticle($articleID);

            $articleArrayEntry = array($article, $quantity);

            array_push($articleArray, $articleArrayEntry);
        }

        $this->closeConnect();
        return $articleArray;
    }

}
