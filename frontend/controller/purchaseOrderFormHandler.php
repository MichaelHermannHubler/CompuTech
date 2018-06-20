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

    $orderId = $purchaseOrderDAO->setPurchaseOrder($id, $offer, $supplier, $createDate, $orderDate, $deliveryStatus, $deliveryType);

    $offerArticleDAO = new OfferArticleDAO();
    $purchaseOrderArticleDAO = new PurchaseOrderArticleDAO();
    $offerArticles = $offerArticleDAO->getOfferArticle($offer);
    foreach ($offerArticles as $offerArticle) {
        $price = $offerArticle->getPrice() * $offerArticle->getQuantity();
        $purchaseOrderArticleDAO->setPurchaseOrderArticle(null, $offerArticle->getArticleNumber(), $orderId, $offerArticle->getQuantity(), 0, $price, 0);
    }
    echo '<h3>Submitted!</h3>';

    header("Location: " . $newURL);
} else if (!empty($_POST['supplier']) && !empty($_POST['orderDate']) && !empty($_POST['deliveryType'])) {
    $purchaseOrderDAO = new PurchaseOrderDAO;
    $id = null;
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
    }
    $offer = null;
    $supplier = $_POST['supplier'];
    $createDate = date("Y-m-d H:i:s");
    $orderDate = $_POST['orderDate'];
    $deliveryStatus = null;
    $deliveryType = $_POST['deliveryType'];

    $orderId = $purchaseOrderDAO->setPurchaseOrder($id, $offer, $supplier, $createDate, $orderDate, $deliveryStatus, $deliveryType);

    echo "<div class='container-fluid'>";
    echo "<h1>Artikel zu Bestellung Hinzufuegen</h1>";

    echo "<p>Order ID: " . $orderId . "</p>";

    if (!empty($_GET['edit'])) {
        $purchaseOrderArticleDAO = new PurchaseOrderArticleDAO();
        $purchaseOrderArticles = $purchaseOrderArticleDAO->getArticlesFromOrderId($orderId);
        $articleDAO = new ArticleDAO();
        echo "<form method='POST' action='purchaseOrderArticleFormHandler.php?edit=true'>";
        echo "<table class='table'>";
        echo "<tr>";
        echo "<th>Nummer</th>";
        echo "<th>Beschreibung</th>";
        echo "<th>Stueckpreis</th>";
        echo "<th>Stueckzahl</th>";
        echo "</tr>";
        foreach ($purchaseOrderArticles as $purchaseOrderArticle) {
            $articleId = $purchaseOrderArticle->getArticleId();
            $article = $articleDAO->getArticle($articleId+10000);
            echo "<tr>";
            echo "<td>";
            echo $articleId;
            echo "</td>";
            echo "<td>";
            echo $article->getArticleDesc();
            echo "</td>";
            echo "<td>";
            echo $purchaseOrderArticle->getPrice();
            echo "</td>";
            echo "<td><input type='number' name='". $purchaseOrderArticle->getId() ."' value='" . $purchaseOrderArticle->getQuantityOrdered() . "'></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<button type='submit' class='btn btn-primary'>Speichern</button>";
        echo "</form>";
    } else {
        $articleDAO = new ArticleDAO;
        $articles = $articleDAO->getArticleFromSupplier($supplier);

        echo "<form method='POST' action='purchaseOrderArticleFormHandler.php'>";
        echo "<input style='display: none' name='supplier' type='text' value='" . $supplier . "'>";
        echo "<input style='display: none' name='purchaseOrder' type='text' value='" . $orderId . "'>";
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
            echo "<td><input type='number' name='" . $article->getArticleNumber() . "' value='0'></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<button type='submit' class='btn btn-primary'>Hinzufuegen</button>";
        echo "</form>";
    }

    echo "</div>";
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
