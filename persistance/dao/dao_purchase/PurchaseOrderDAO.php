<?php

include_once '../../model/PurchaseOrder.php';

Class PurchasOrderDAO extends AbstractDAO {

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

    function setPurchaseOrder($id, $offer, $supplier, $createDate, $oderDate, $deliveryStatus, $deliveryType) {
        $this->doConnect();

        if ($id == null) {
            $stmt = $this->conn->prepare("insert into purchaseorder (OfferID, SuplierID, SysDateCreated, OrderDate, DeliveryStatus, DeliveryType) values (?,?,?,?,?,?)");
            $stmt->bind_param("iiiiii", $offer, $supplier, $createDate, $oderDate, $deliveryStatus, $deliveryType);
        } else {
            $stmt = $this->conn->prepare("update purchaseorder set OfferID = ?, SuplierID = ?, SysDateCreated = ?, OrderDate = ?, DeliveryStatus = ?, DeliveryType = ? where ID = ?");
            $stmt->bind_param("iiiiiii", $offer, $supplier, $createDate, $oderDate, $deliveryStatus, $deliveryType, $id);
        }

        $stmt->execute();

        if ($id == null && $stmt->fetch()) {
            $id = mysqli_insert_id($stmt);
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

}
