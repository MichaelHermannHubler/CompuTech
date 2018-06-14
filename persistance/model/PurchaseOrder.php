<?php


Class PurchaseOrder extends Voucher {

    private $orderDate;
    private $offerNumber = null;
    private $orderStatus;
    private $deliveryType;

    function __construct($num, $party, $createDate, $offerNum, $orderDate, $orderStatus, $deliveryType) {
        parent::__construct($num, $party, $createDate);
        $this->offerNumber = $offerNum;
        $this->orderDate = $orderDate;
        $this->deliveryType = $deliveryType;
        $this->orderStatus = $orderStatus;
    }

    function setOrder($party, $createDate, $offerNum, $orderStatus, $deliveryType) {
        $db = new SupplierDAO();
        $check = $db->checkSupplier($party);
        if ($check) {
            $this->party = $party;
        } else {
            echo "VendorNumber doesn't exist.";
        }
        $this->createDate = $createDate;
        $this->offerNumber = $offerNum;
        $this->orderStatus = $orderStatus;
        $this->deliveryType = $deliveryType;

        $OrderDB = new PurchasOrderDAO;

        if ($this->num == null) {
            $this->num = $OrderDB->setPurchaseOrder($this->num, $this->offerNumber, $this->party, $this->createDate, $this->orderDate, $this->orderStatus, $this->deliveryType);
        } else {
            $OrderDB->setPurchaseOrder($this->num, $this->offerNumber, $this->party, $this->createDate, $this->orderDate, $this->orderStatus, $this->deliveryType);
        }
    }

    function getOrderDate() {
        return $this->orderDate;
    }

    function getOfferNumber() {
        return $this->offerNumber;
    }

    function order() {
        $this->orderDate = new Date('Y-m-d h:i:s');
    }

    function getOrderStatus() {
        return $this->orderStatus;
    }

    function getDeliveryType() {
        return $this->deliveryType;
    }

}
