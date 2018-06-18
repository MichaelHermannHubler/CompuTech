<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/includes.php';

if (!empty($_POST['artikelauswahl'])) {

    $createDate = date("Y-m-d H:i:s");

    $offerOrderDAO = new OfferOrderDAO;

    $num = 1001 + $offerOrderDAO->getHighestID();

    $offerOrder = new OfferOrders($num, $_SESSION['supplierID'], $createDate, null);

    $id = $offerOrder->setOffer($num, $_SESSION['supplierID'], $createDate, null);


    if (!empty($_POST['articleaquantity'])) {
        $AofferArticle = new OfferArticles($_POST['articleasupplier'], null, $_POST['articleaquantity'], $id);
        $AofferArticle->setOfferArticlesOffer($_POST['articleasupplier'], $id, null, $_POST['articleaquantity']);
    }
    if (!empty($_POST['articlebquantity'])) {
        $BofferArticle = new OfferArticles($_POST['articlebsupplier'], null, $_POST['articlebquantity'], $id);
        $BofferArticle->setOfferArticlesOffer($_POST['articlebsupplier'], $id, null, $_POST['articlebquantity']);
    }
    if (!empty($_POST['articlecquantity'])) {
        $CofferArticle = new OfferArticles($_POST['articlecsupplier'], null, $_POST['articlecquantity'], $id);
        $CofferArticle->setOfferArticlesOffer($_POST['articlecsupplier'], $id, null, $_POST['articlecquantity']);
    }

    header("Location: http://localhost/Computech/frontend/?menu=offer");
    
}
