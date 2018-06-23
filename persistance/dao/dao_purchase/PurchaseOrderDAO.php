<?php


Class PurchaseOrderDAO extends AbstractDAO {

    function __construct() {
        
    }

    function getPurchaseOrder($id) {
        $this->doConnect();

        $stmt = $this->conn->prepare("select ID, OfferID, SuplierID, SysDateCreated, OrderDate, DeliveryStatus, DeliveryType from purchaseorder where ID = ?");

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $stmt->bind_result($id, $offer, $supplier, $create, $orderDate, $deliveryStatus, $deliveryType);

        $orders = array();
        while ($stmt->fetch()) {
            $order = new PurchaseOrder($id, $supplier, $create, $offer, $orderDate, $deliveryStatus, $deliveryType);
            array_push($orders, $order);
        }

        $this->closeConnect();
        return $orders;
    }

    function getAllPurchaseOrder() {
        $this->doConnect();

        $stmt = $this->conn->prepare("select ID, OfferID, SuplierID, SysDateCreated, OrderDate, DeliveryStatus, DeliveryType from purchaseorder");

        $stmt->execute();

        $stmt->bind_result($id, $offer, $supplier, $create, $orderDate, $deliveryStatus, $deliveryType);

        $orders = array();
        while ($stmt->fetch()) {
            $order = new PurchaseOrder($id, $supplier, $create, $offer, $orderDate, $deliveryStatus, $deliveryType);
            array_push($orders, $order);
        }

        $this->closeConnect();
        return $orders;
    }

    function getPurchaseOrderFromVendor($vendor) {
        $this->doConnect();

        $stmt = $this->conn->prepare("select ID, OfferID, SuplierID, SysDateCreated, OrderDate, DeliveryStatus, DeliveryType from purchaseorder where SuplierID = ?");

        $stmt->bind_param("", $vendor);

        $stmt->execute();

        $stmt->bind_result($id, $offer, $supplier, $create, $orderDate, $deliveryStatus, $deliveryType);

        $orders = array();
        while ($stmt->fetch()) {
            $order = new PurchaseOrder($id, $supplier, $create, $offer, $orderDate, $deliveryStatus, $deliveryType);
            array_push($orders, $order);
        }

        $this->closeConnect();
        return $orders;
    }

    function setPurchaseOrder($id, $offer, $supplier, $createDate, $orderDate, $deliveryStatus, $deliveryType) {
        $this->doConnect();

        if ($id == null) {
            $stmt = $this->conn->prepare("insert into purchaseorder (OfferID, SuplierID, SysDateCreated, OrderDate, DeliveryStatus, DeliveryType) values (?,?,?,?,?,?)");
            $stmt->bind_param("iissss", $offer, $supplier, $createDate, $orderDate, $deliveryStatus, $deliveryType);
        } else {
            $stmt = $this->conn->prepare("update purchaseorder set OfferID = ?, SuplierID = ?, SysDateCreated = ?, OrderDate = ?, DeliveryStatus = ?, DeliveryType = ? where ID = ?");
            $stmt->bind_param("iissssi", $offer, $supplier, $createDate, $orderDate, $deliveryStatus, $deliveryType, $id);
        }

        $stmt->execute();

       if($id == null){
            $id = $stmt->insert_id;
       }
           
        

        $this->closeConnect();
        return $id;
    }

    function getUnorderedPurchaseOrder($supplierId) {
        $this->doConnect();
        $stmt = $this->conn->prepare("select ID from purchaseorder where SuplierID = ? and OrderDate = null");
        $stmt->bind_param("i", $supplierId);
        $stmt->execute();
        $stmt->bind_result($id);

        if ($stmt->fetch()) {
            $id = $id;
        }
        $this->closeConnect();
        return $id;
    }

    function getPurchaseOrderArticles($orderId)
    {
        $this->doConnect();
        $stmt = $this->conn->prepare("SELECT ID, ArticleID, QuantityOrdered, coalesce(QuantityDelivered, 0), Defective from orderarticle where OrderID = ?");
        $stmt->bind_param("i", $orderId);

        $stmt->execute();

        $articleID = 0;
        $quantityOrd = 0;
        $quantityDel = 0;
        $id = 0;
        $defective = 0;
        $stmt->bind_result($id, $articleID, $quantityOrd, $quantityDel, $defective);

        $articleArray = array();

        while($stmt->fetch())
        {
            $articleGetter = new ArticleDAO();
            $article = $articleGetter->getArticle($articleID);

            $articleArrayEntry = array($article, $id, $quantityOrd, $quantityDel, $defective);

            array_push($articleArray, $articleArrayEntry);
        }

        $this->closeConnect();
        return $articleArray;
    }

    function setPurchaseOrderArticle($id, $deliveredAdd, $defective){
        $this->doConnect();

        $stmt = $this->conn->prepare("update orderarticle set QuantityDelivered = coalesce(QuantityDelivered, 0) + ?, Defective = ? where ID = ?");
        $stmt->bind_param('ibi', $deliveredAdd, $defective, $id);


        $stmt->execute();
        $this->closeConnect();
    }

    function setComplete($id, $type){
        $this->doConnect();

        $stmt = $this->conn->prepare("update purchaseorder set DeliveryType = ? where ID = ?");
        $stmt->bind_param('si', $type, $id);

        $stmt->execute();
        $this->closeConnect();
    }

}
