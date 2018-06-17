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
    
    header("Location: ".$newURL);
    
} else if (!empty($_POST['supplier']) && !empty($_POST['orderDate']) && !empty($_POST['deliveryType'])) {
    $purchaseOrderDAO = new PurchaseOrderDAO;
    
    $id = null;
    $offer = null;
    $supplier = $_POST['supplier'];
    $createDate = date("Y-m-d H:i:s");
    $orderDate = $_POST['orderDate'];
    $deliveryStatus = null;
    $deliveryType = $_POST['deliveryType'];
    
    $articleDAO = new ArticleDAO;
    $articles = $articleDAO->getArticleFromSupplier($supplier);
    
    echo "<h1>Artikel zu Bestellung Hinzufuegen</h1>"; 
    
    echo "<form method='POST' method=''>";
    echo "<table class='table'>";
    echo "<tr>";
    echo "<th>Nummer</th>";
    echo "<th>Beschreibung</th>";
    echo "<th>Stueckpreis</th>";
    echo "<th>Stueckzahl</th>";
    echo "</tr>";
    foreach ($articles as $article) {
        echo "<tr>";
        echo "<td>";
        echo $article->getArticleNumber();
        echo "</td>";
        echo "<td>";
        echo $article->getArticleDesc();
        echo "</td>";
        echo "<td>";
        echo $article->getSellingPrice();
        echo "</td>";
        echo "<td><input type='number' name='" . $article->getArticleNumber() . "amount' value='0'></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<button type='submit' class='btn btn-primary'>Hinzufuegen</button>";
    echo "</form>";
    $id = $purchaseOrderDAO->setPurchaseOrder($id, $offer, $supplier, $createDate, $orderDate, $deliveryStatus, $deliveryType);
    echo '<h3>Submitted!</h3>';
    
}

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">