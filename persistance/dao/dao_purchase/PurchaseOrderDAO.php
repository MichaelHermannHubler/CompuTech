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
        echo "Hi";
        echo "id".$id;
        echo"<br/>";
        echo "Angebot".$offer;
        echo"<br/>";
        echo"supplier".$supplier;
        echo"<br/>";
        echo "createDate".$createDate;
        echo"<br/>";
        echo "orderDate".$orderDate;
        echo"<br/>";
        echo "Deliverystat".$deliveryStatus;
        echo"<br/>";
        echo "deliverytype".$deliveryType;
        echo"<br/>";

        if ($id == null) {
            echo "null";
            $stmt = $this->conn->prepare("insert into purchaseorder (OfferID, SuplierID, SysDateCreated, OrderDate, DeliveryStatus, DeliveryType) values (?,?,?,?,?,?)");
            $stmt->bind_param("iissss", $offer, $supplier, $createDate, $orderDate, $deliveryStatus, $deliveryType);
        } else {
            echo "nicht null";
            $stmt = $this->conn->prepare("update purchaseorder set OfferID = ?, SuplierID = ?, SysDateCreated = ?, OrderDate = ?, DeliveryStatus = ?, DeliveryType = ? where ID = ?");
            $stmt->bind_param("iissssi", $offer, $supplier, $createDate, $orderDate, $deliveryStatus, $deliveryType, $id);
        }

        $stmt->execute();

       if($id == null){
            echo "Hi ich bins";
            echo "ID zuvor".$id;
            $id = $stmt->insert_id;
            echo "ID jetzt".$id;
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
