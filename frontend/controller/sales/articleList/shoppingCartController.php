<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 04.06.2018
 * Time: 13:53
 */

include_once$_SERVER['DOCUMENT_ROOT'] . '/CompuTech/service/ArticleService.php';
include_once$_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/controller/loginController.php';



$arrayUtil = new ArrayUtil();
//var_dump($_SESSION['articleList']);
if (isset($_GET['articleIdToAdd']) && isset($_GET['desc']) && isset($_GET['price'])) {
    $article = null;

    if (!isset($_SESSION['articleList'])){
        $_SESSION['articleList'] = array();
    }

    foreach ($_SESSION['articleList'] as $item) {
        echo "Available Article:".$item->getArticleId();
        if ($item->getArticleId() == $_GET['articleIdToAdd']) {
            $item->setAmount($item->getAmount() + 1);
            echo "Matching Article:".$item->getArticleId();
            $article = $item;
            break;
        }
    }

    if ($article == null) {
        $article = new ArticleListDTO($_GET['articleIdToAdd'], 1, $_GET['desc'], $_GET['price']);
        echo "Add new article:".$article->getArticleId();
        $_SESSION['articleList'][]= $article;
    }
    //var_dump($_SESSION['articleList']);

}

if (isset($_GET['articleIdToDelete'])) {
    echo "articleIdToDelete:".$_GET['articleIdToDelete'];

    foreach ($_SESSION['articleList'] as $item) {
        if ($item->getArticleId() == $_GET['articleIdToDelete']) {
            echo "foundArticle";
            if ($item->getAmount() > 0) {
                $item->setAmount($item->getAmount() - 1);
                echo "reduce";
            }
        }
    }


}

