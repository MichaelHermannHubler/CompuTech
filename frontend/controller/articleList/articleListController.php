<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 04.06.2018
 * Time: 13:53
 */

$_SESSION['articleList'] = array();

$arrayUtil = new ArrayUtil();

if (isset($_GET['articleIdToAdd']) && isset($_GET['desc'])) {


    foreach ($_SESSION['articleList'] as $item) {
        if ($item->getArticleId() == $_GET['articleIdToAdd']) {
            $item->setAmount($item->getAmount() + 1);
            $article = $item;
            break;
        }
    }

    if ($article == null) {
        array_push($_SESSION['articleList'], new ArticleListDTO($_GET['articleIdToAdd'], 1, $_GET['desc']));
    }


}

if (isset($_GET['articleIdToDelete'])) {

    foreach ($_SESSION['articleList'] as $item) {
        if ($item->getArticleId() == $_GET['articleIdToDelete']) {
            if ($item->getAmount() == 1) {
                $item->setAmount($item->getAmount() - 1);
            } else {
                $arrayUtil->array_remove($_SESSION['articleList'], $item);

            }
        }
    }


}