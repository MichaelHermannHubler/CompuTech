<?php

include_once '../../persistance/dao/dao_purchase/ArticleDAO.php';
include_once '../../persistance/model/Article.php';

$db = new ArticleDAO;
$stock = $db->getStockList();

for ($i = 0; $i < count($stock); $i++) {
    echo "<div class=\"article\">";
    echo $stock[$i]->getArticleNumber();
    echo "<br/>";
    echo $stock[$i]->getArticleDesc();
    echo "<br/>";
    echo $stock[$i]->getArticleGroup();
    echo "<br/>";
    echo $stock[$i]->getBuyingPrice();
    echo "<br/>";
    echo $stock[$i]->getSellingPrice();
    echo "<br/>";
    echo $stock[$i]->getUnit();
    echo "<br/>";
    echo $stock[$i]->getPackingUnit();
    echo "<br/>";
    echo $stock[$i]->getPackingSize();
    echo "<br/>";
    echo $stock[$i]->getMinimumLevel();
    echo "<br/>";
    echo $stock[$i]->getVendor();
    echo "<br/>";
    echo "<button class=\"ModifyArticle\" value=" . $stock[$i]->getArticleNumber() . ">Bearbeiten</button>";
    echo "</div>";
}

