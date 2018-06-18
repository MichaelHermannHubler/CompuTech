<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/includes.php';

if (!empty($_GET['speichern'])) {
    echo $_SESSION['num'];
    echo "<br/>";
    echo $_SESSION['id'];
    
    $offerArticleDAO = new OfferArticleDAO;
    
    $offerArticleDAO->setOfferArticle($_SESSION['num'], $_SESSION['id'], $_GET['price'], $_GET['quantity']);
    
    //header("Location: http://localhost/Computech/frontend/?menu=offer");
}

