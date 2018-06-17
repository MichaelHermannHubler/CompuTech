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

$newURL = "http://localhost/Computech/frontend/views/orders.php?success=true";

if (!empty($_POST['supplier']) && !empty($_POST['purchaseOrder'])) {
    $supplier = $_POST['supplier'];
    $purchaseOrder = $_POST['purchaseOrder'];
    $purchaseOrderArticleDAO = new PurchaseOrderArticleDAO;
    $articleDAO = new ArticleDAO;
    foreach ($_POST as $key => $value) {
        if ($key != 'supplier' && $key != 'purchaseOrder') {
            if ($value > 0) {
                $id = null;
                $articleId = $key;
                $quantityOrdered = $value;
                $quantityDelivered = 0;
                $price = $articleDAO->getArticle($articleId)->getSellingPrice();
                $defective = 0;
                $purchaseOrderArticleDAO->setPurchaseOrderArticle($id, $articleId, $purchaseOrder, $quantityOrdered, $quantityDelivered, $price, $defective);
            }
        }
    }
}

header("Location: " . $newURL);
