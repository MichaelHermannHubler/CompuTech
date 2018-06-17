<?php

Class OfferOrderDAO extends AbstractDAO {

    function __construct() {
        
    }

    function getOfferOrderFromSupplier($vendor) {
        $this->doConnect();
        $stmt = $this->conn->prepare("select Number, SupplierID, SysDateCreated, totalprice from offer where SupplierID = ?");

        $stmt->bind_param("i", $vendor);

        $stmt->execute();

        $stmt->bind_result($number, $supplierID, $createDate, $total);

        $vendorOffers = array();
        while ($stmt->fetch()) {
            $offer = new OfferOrders($number, $supplierID, $createDate, $total);
            array_push($vendorOffers, $offer);
        }

        $this->closeConnect();
        return $vendorOffers;
    }
    
    function getOfferOrderFromId($id) {
        $this->doConnect();
        $stmt = $this->conn->prepare("select Number, SupplierID, SysDateCreated, totalprice from offer where ID = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();

        $stmt->bind_result($number, $supplierID, $createDate, $total);

        $offer = null;
        while ($stmt->fetch()) {
            $offer = new OfferOrders($number, $supplierID, $createDate, $total);
        }

        $this->closeConnect();
        return $offer;
    }

    function getAllOfferOrder() {
        $this->doConnect();

        $stmt = $this->conn->prepare("select Number, SupplierID, SysDateCreated, totalprice from offer");

        $stmt->execute();

        $stmt->bind_result($number, $supplierID, $createDate, $total);

        $offers = array();

        while ($stmt->fetch()) {
            $offer = new OfferOrders($number, $supplierID, $createDate, $total);
            array_push($offers, $offer);
        }

        $this->closeConnect();
        return $offers;
    }

    function getOfferOrderOnDate($DateMatcher) {
        $this->doConnect();

        $stmt = $this->conn->prepare("select Number, SupplierID, SysDateCreated, totalprice from offer where SysDateCreated = ?");

        $stmt->execute();

        $stmt->bind_result($number, $supplierID, $createDate, $total);

        $offers = array();

        while ($stmt->fetch()) {
            $offer = new OfferOrders($number, $supplierID, $createDate, $total);
            array_push($offers, $offer);
        }

        $this->closeConnect();
        return $offers;
    }

    function setOfferOrder($number, $vendor, $date, $total) {
        $this->doConnect();

        $id = $this->getOfferIDFromNumber($number);

        if ($id == null) {
            $link = $this->doConnect();
            $query = "INSERT into offer (Number, SupplierID, SysDateCreated, totalprice) values ('$number',$vendor, $date, $total)";
            mysqli_query($this->conn, $query);
           /* $stmt = $this->conn->prepare("insert into offer (Number, SupplierID, SysDateCreated, totalprice) values (?,?,?,?)");
            $stmt->bind_param("iid", $number, $vendor, $date, $total);*/
        } else {
            $link = $this->doConnect();
            $query = "update article set Number = '$number', SupplierID = $vendor, totalPrice = $total where ID = $id";
            mysqli_query($this->conn, $query);
         /*   $stmt = $this->conn->prepare("update offer set Number = ?, SupplierID = ?, totalPrice = ? where ID = ?");
            $stmt->bind_param("iii", $number, $vendor, $id, $total);*/
        }

        //$stmt->execute();

        $this->closeConnect();
    }

    function getAvailableOffer($vendor) {

        $this->doConnect();

        $stmt = $this->conn->prepare("select ID from offer of left join order or on of.ID = or.OfferID where SupplierID = ? and or.ID = null");

        $stmt->bind_param("i", $vendor);

        $stmt->execute();

        $stmt->bind_result($id);

        if ($stmt->fetch()) {
            $id = $id;
        }

        $this->closeConnect();
        return $id;
    }

    function getOfferIDFromNumber($number) {
        $this->doConnect();

        $stmt = $this->conn->prepare("SELECT distinct ID from offer where Number = ?");

        $stmt->bind_param("i", $number);

        $stmt->execute();

        $stmt->bind_result($id);

        if ($stmt->fetch()) {
            $id = $id;
        }
        $this->closeConnect();

        return $id;
    }

}
