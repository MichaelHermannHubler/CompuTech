<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/includes.php';

if (!empty($_POST['speichern'])) {

    if (!empty($_POST['num0'])) {
        $offerArticleDAO = new OfferArticleDAO;
        $offerArticleDAO->setOfferArticle($_POST['num0'], $_SESSION['id'], $_POST['price0'], $_POST['quantity0']);
    }
    if (!empty($_POST['num1'])) {
        $offerArticleDAO->setOfferArticle($_POST['num1'], $_SESSION['id'], $_POST['price1'], $_POST['quantity1']);
    }
    if (!empty($_POST['num2'])) {
        $offerArticleDAO->setOfferArticle($_POST['num2'], $_SESSION['id'], $_POST['price2'], $_POST['quantity2']);
    }


    header("Location: http://localhost/Computech/frontend/?menu=offer");
}

