<?php

Class ArticleDAO extends AbstractDAO {

    function __construct() {
        
    }

    function getArticlesFromOrderId($orderId) {
        $this->doConnect();

        $stmt = $this->conn->prepare("select OrderID, ArticleID, QuanitityOrdered, QuantityDelivered, Price, Defective from orderarticle where SupplierID = ?");

        $stmt->bind_param("i", $orderId);

        $stmt->execute();

        $stmt->bind_result($orderId, $articleId, $quantityOrdered, $quantityDelivered, $price, $defective);
        
        $orderArticles = array();
        while ($stmt->fetch()) {
            $orderArticle = new PurchaseOrderArticle($articleId, $quantityOrdered, $quantityDelivered, $price, $defective);
            array_push($orderArticles, $orderArticle);
        }

        $this->closeConnect();

        return $orderArticles;
    }

    function setPurchaseOrderArticle($id, $articleId, $orderId, $quantityOrdered, $quantityDelivered, $price, $defective) {
        $this->doConnect();
        
        if ($id == null) {
            $stmt = $this->conn->prepare("insert into orderarticle (ArticleID, OfferID, QuantityOrdered, QuantityDelivered, Price, Defective) values (?,?,?,?,?,?)");
            $stmt->bind_param("iiiiii", $articleId, $orderId, $quantityOrdered, $quantityDelivered, $price, $defective);
        } else {
            $stmt = $this->conn->prepare("update purchaseorder set ArticleID = ?, OfferID = ?, QuantityOrdered = ?, QuantityDelivered = ?, Price = ?, Defective = ? where ID = ?");
            $stmt->bind_param("iiiiiii", $articleId, $orderId, $quantityOrdered, $quantityDelivered, $price, $defective, $id);
        }

        $stmt->execute();
        
        echo $stmt->error;

        if ($id == null && $stmt->fetch()) {
            $id = mysqli_insert_id($stmt);
        }

        $this->closeConnect();
        return $id;
    }
}
