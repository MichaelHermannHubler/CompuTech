#<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 17.06.2018
 * Time: 16:14
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/service/ArticleService.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/controller/sales/articleList/shoppingCartController.php';



if (isset($_GET['bestellen']) && $_GET['bestellen']) {

    $articleService = new ArticleService();
    $result = $articleService->processOrder($_SESSION['articleList'], $_SESSION['versand'],$_SESSION['rechnung']);
    if (is_bool($result)){
        echo "Bestellung wurde erstellt";

        //Delete everything in session

        $_SESSION['articleList'] = array();
        $_SESSION['versand'] = null;
        $_SESSION['rechnung'] = null;

        echo "<a href='ArticleListController.php'>Zurück zum Shop/a>";
    }
    else{
        echo "Es ist".$result." Artikel nicht mehr verfügbar";

        echo "<a href='articleList/shoppingCartDisplay.php'>Zurück in den Warenkorb</a>";
    }


}