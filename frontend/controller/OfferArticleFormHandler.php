<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/includes.php';

if (!empty($_GET['artikelauswahl'])) {

    $createDate = date("Y-m-d H:i:s");

    $offerOrderDAO = new OfferOrderDAO;

    $num = 1001 + $offerOrderDAO->getHighestID();

    $offerOrder = new OfferOrders($num, $_SESSION['supplierID'], $createDate, null);

    $id = $offerOrder->setOffer($num, $_SESSION['supplierID'], $createDate, null);


    if (!empty($_GET['articleaquantity'])) {
        $AofferArticle = new OfferArticles($_GET['articleasupplier'], null, $_GET['articleaquantity'], $id);
        $AofferArticle->setOfferArticlesOffer($_GET['articleasupplier'], $id, null, $_GET['articleaquantity']);
    }
    if (!empty($_GET['articlebquantity'])) {
        $BofferArticle = new OfferArticles($_GET['articlebsupplier'], null, $_GET['articlebquantity'], $id);
        $BofferArticle->setOfferArticlesOffer($_GET['articlebsupplier'], $id, null, $_GET['articlebquantity']);
    }
    if (!empty($_GET['articlecquantity'])) {
        $CofferArticle = new OfferArticles($_GET['articlecsupplier'], null, $_GET['articlecquantity'], $id);
        $CofferArticle->setOfferArticlesOffer($_GET['articlecsupplier'], $id, null, $_GET['articlecquantity']);
    }

    header("Location: http://localhost/Computech/frontend/?menu=offer");
    ;
}
