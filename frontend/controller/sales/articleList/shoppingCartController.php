<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 04.06.2018
 * Time: 13:53
 */

include_once$_SERVER['DOCUMENT_ROOT'] . '/computech/service/ArticleService.php';
include_once$_SERVER['DOCUMENT_ROOT'] . '/computech/frontend/controller/loginController.php';

include_once $_SERVER['DOCUMENT_ROOT'] . '/computech/persistance/model/Address.php';


$arrayUtil = new ArrayUtil();
//var_dump($_SESSION['articleList']);
if (isset($_GET['articleIdToAdd']) && isset($_GET['desc']) && isset($_GET['price'])) {
    $article = null;

    if (!isset($_SESSION['articleList'])){
        $_SESSION['articleList'] = array();
    }

    foreach ($_SESSION['articleList'] as $item) {
        if ($item->getArticleId() == $_GET['articleIdToAdd']) {
            $item->setAmount($item->getAmount() + 1);
            $article = $item;
            break;
        }
    }

    if ($article == null) {
        $article = new ArticleListDTO($_GET['articleIdToAdd'], 1, $_GET['desc'], $_GET['price']);
        $_SESSION['articleList'][]= $article;
    }
    //var_dump($_SESSION['articleList']);

}

if (isset($_GET['articleIdToDelete'])) {

    foreach ($_SESSION['articleList'] as $item) {
        if ($item->getArticleId() == $_GET['articleIdToDelete']) {
            if ($item->getAmount() > 0) {
                $item->setAmount($item->getAmount() - 1);
            }
        }
    }


}

