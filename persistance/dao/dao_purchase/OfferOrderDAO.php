<?php

include_once '../../model/OfferOrders.php';

Class OfferOrderDAO extends AbstractDAO {

    function __construct() {
        
    }

    function getOfferOrderFromSupplier($vendor) {
        $this->doConnect();
        $stmt = $this->conn->prepare("select Number, SupplierID, SysDateCreated from offer where SupplierID = ?");

        $stmt->bind_param("i", $vendor);

        $stmt->execute();

        $stmt->bind_result($number, $supplierID, $createDate);

        $vendorOffers = array();
        while ($stmt->fetch()) {
            $offer = new OfferOrders($number, $supplierID, $createDate);
            array_push($vendorOffers, $offer);
        }

        $this->closeConnect();
        return $vendorOffers;
    }

    function getAllOfferOrder() {
        $this->doConnect();

        $stmt = $this->conn->prepare("select Number, SupplierID, SysDateCreated from offer");

        $stmt->execute();

        $stmt->bind_result($number, $supplierID, $createDate);

        $offers = array();

        while ($stmt->fetch()) {
            $offer = new OfferOrders($number, $supplierID, $createDate);
            array_push($offers, $offer);
        }

        $this->closeConnect();
        return $offers;
    }

    function getOfferOrderOnDate($DateMatcher) {
        $this->doConnect();

        $stmt = $this->conn->prepare("select Number, SupplierID, SysDateCreated from offer where SysDateCreated = ?");

        $stmt->execute();

        $this->closeConnect();
    }

    function setOfferOrder($number, $vendor, $date) {
        $this->doConnect();

        $id = $this->getOfferIDFromNumber($number);

        if ($id == null) {
            $stmt = $this->conn->prepare("insert into offer (Number, SupplierID, SysDateCreated) values (?,?,?");
            $stmt->bind_param("iid", $number, $vendor, $date);
        } else {
            $stmt = $this->conn->prepare("update offer set Number = ?, SupplierID = ? where ID = ?");
            $stmt->bind_param("iii", $number, $vendor, $id);
        }

        $stmt->execute();

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
