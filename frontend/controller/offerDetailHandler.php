<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/includes.php';

if (!empty($_GET['speichern'])) {

    if (!empty($_GET['num0'])) {
        $offerArticleDAO = new OfferArticleDAO;
        $offerArticleDAO->setOfferArticle($_GET['num0'], $_SESSION['id'], $_GET['price0'], $_GET['quantity0']);
    }
    if (!empty($_GET['num1'])) {
        $offerArticleDAO->setOfferArticle($_GET['num1'], $_SESSION['id'], $_GET['price1'], $_GET['quantity1']);
    }
    if (!empty($_GET['num2'])) {
        $offerArticleDAO->setOfferArticle($_GET['num2'], $_SESSION['id'], $_GET['price2'], $_GET['quantity2']);
    }


    header("Location: http://localhost/Computech/frontend/?menu=offer");
}

