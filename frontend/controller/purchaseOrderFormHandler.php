<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/includes.php';


foreach ($_POST as $key => $value) {
    echo 'key: ' . $key . '<br>';
    echo 'value: ' . $value . '<br>';
    
};


if (!empty($_POST['offer']) && empty($_POST['supplier'])) {

    
} else if (!empty($_POST['offer']) && !empty($_POST['supplier']) && !empty($_POST['createDate']) && !empty($_POST['orderDate']) && !empty($_POST['deliveryType'])) {
    $purchaseOrderDAO = new PurchaseOrderDAO;
    //$purchaseOrder = new PurchaseOrder();
    
    $id = null;
    $offer = $_POST['offer'];
    $supplier = $_POST['supplier'];
    $createDate = $_POST['createDate'];
    $orderDate = $_POST['orderDate'];
    $deliveryStatus = null;
    $deliveryType = $_POST['deliveryType'];
    
    $purchaseOrderDAO->setPurchaseOrder($id, $offer, $supplier, $createDate, $orderDate, $deliveryStatus, $deliveryType);
    echo '<h3>Submitted!</h3>';
    
}