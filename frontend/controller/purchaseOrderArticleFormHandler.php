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

$newURL = "http://localhost/CompuTech/frontend/?menu=order&success=true";

if (!empty($_POST['supplier']) && !empty($_POST['purchaseOrder'])) {
    $supplier = $_POST['supplier'];
    $purchaseOrder = $_POST['purchaseOrder'];
    $purchaseOrderArticleDAO = new PurchaseOrderArticleDAO();
    $articleDAO = new ArticleDAO();
    foreach ($_POST as $key => $value) {
        if ($key != 'supplier' && $key != 'purchaseOrder') {
            if ($value > 0) {
                $id = null;
                $articleId = $articleDAO->getArticle($key)->getID();
                $quantityOrdered = $value;
                $quantityDelivered = 0;
                $price = $articleDAO->getArticle($key)->getSellingPrice() * $quantityOrdered;
                $defective = 0;
                $purchaseOrderArticleDAO->setPurchaseOrderArticle($id, $articleId, $purchaseOrder, $quantityOrdered, $quantityDelivered, $price, $defective);
            }
        }
    }
} else {
    $purchaseOrderArticleDAO = new PurchaseOrderArticleDAO();
    foreach ($_POST as $key => $value) {
        $id = $key;
        $quantityOrdered = $value;
        $purchaseOrderArticleDAO->setQuantity($id, $quantityOrdered);
    }
}

header("Location: " . $newURL);
