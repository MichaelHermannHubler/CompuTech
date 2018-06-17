<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/includes.php';

/*
foreach ($_POST as $key => $value) {
    echo 'key: ' . $key . '<br>';
    echo 'value: ' . $value . '<br>';
    
};
*/

if (!empty($_POST['offer'])) {
    $offerOrderDAO = new OfferOrderDAO;
    $purchaseOrderDAO = new PurchaseOrderDAO;
    
    $id = null;
    $offer = $_POST['offer'];
    $offerOrder = $offerOrderDAO->getOfferOrderFromId($offer);
    $supplier = $offerOrder->getParty();
    $createDate = date("Y-m-d H:i:s");
    $orderDate = $offerOrder->getCreateDate();
    $deliveryStatus = null;
    $deliveryType = null;
    
    $purchaseOrderDAO->setPurchaseOrder($id, $offer, $supplier, $createDate, $orderDate, $deliveryStatus, $deliveryType);
    echo '<h3>Submitted!</h3>';
    
} else if (!empty($_POST['supplier']) && !empty($_POST['orderDate']) && !empty($_POST['deliveryType'])) {
    $purchaseOrderDAO = new PurchaseOrderDAO;
    
    $id = null;
    $offer = null;
    $supplier = $_POST['supplier'];
    $createDate = date("Y-m-d H:i:s");
    $orderDate = $_POST['orderDate'];
    $deliveryStatus = null;
    $deliveryType = $_POST['deliveryType'];
    
    $purchaseOrderDAO->setPurchaseOrder($id, $offer, $supplier, $createDate, $orderDate, $deliveryStatus, $deliveryType);
    echo '<h3>Submitted!</h3>';
    
}