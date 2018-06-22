#<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 17.06.2018
 * Time: 16:14
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/computech/service/ArticleService.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/computech/frontend/controller/sales/articleList/shoppingCartController.php';


if (isset($_GET['bestellen']) && $_GET['bestellen']) {
    echo "<div class='container'>";


    echo "<div class='card'>  <div class='card-body'>";

    $articleService = new ArticleService();
    $result = $articleService->processOrder($_SESSION['articleList'], $_SESSION['versand'], $_SESSION['rechnung'], $_SESSION['user']->getUsername());
    if (is_bool($result)) {
        echo "Bestellung wurde erstellt";

        //Delete everything in session

        $_SESSION['articleList'] = array();
        $_SESSION['versand'] = null;
        $_SESSION['rechnung'] = null;

        echo "<br>";


        echo "<a type='button' class='btn btn-outline-secondary my-2 my-sm-0' href='../../'>Zurück zum Shop</a>";
    } else {
        echo "Es ist Artikel" . $result . " nicht mehr verfügbar";
        echo "<br>";
        echo "<a type='button' class='btn btn-outline-secondary my-2 my-sm-0' href='articleList/shoppingCartDisplay.php'>Zurück in den Warenkorb</a>";
    }

    echo "</div>";
    echo "</div>";
    echo "</div>";
}