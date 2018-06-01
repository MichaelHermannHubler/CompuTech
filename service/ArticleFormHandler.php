<?php

if (!empty($_GET['subNewArticle']) && !empty($_GET['name']) && !empty($_GET['group']) && !empty($_GET['buyPrice']) && !empty($_GET['sellPrice']) && !empty($_GET['unit']) && !empty($_GET['packUnit']) && !empty($_GET['packSize']) && !empty($_GET['minStock']) && !empty($_GET['vendor']) && !empty($_GET['surcharge'])) {
    include '../persistance/model/Article.php';

    $article = new Article(null, $_GET['name'], $_GET['group'], $_GET['buyPrice'], $_GET['sellPrice'], $_GET['unit'], $_GET['packUnit'], $_GET['packSize'], $_GET['minStock'], $_GET['vendor'], $_GET['surcharge']);
    
    
} else if (!empty($_GET['modArticle']) && !empty($_SESSION['articleNum'])) {
    include '../persistance/dao/dao_purchase/ArticleDAO.php';
    $db = new ArticleDAO;
    
    $article = $db->getArticle($_SESSION['articleNum']);

    if (!empty($_GET['name']) && $_GET['name'] != null && $_GET['name'] != "") {
        $desc = $_GET['name'];
    }else{
        $desc = $article->getArticleDesc();
    }
    
    if (!empty($_GET['group']) && $_GET['group'] != null && $_GET['group'] != 0){
        $group = $_GET['group'];
    }else{
        $group = $article->getArticleGroup();
    }
    if(!empty($_GET['buyPrice']) && $_GET['buyPrice'] != null && $_GET['buyPrice'] > 0){
        $buyPrice = $_GET['buyPrice'];
    }else{
        $buyPrice = $article->getBuyingPrice();
    }
    if(!empty($_GET['sellPrice']) && $_GET['sellPrice'] != null && $_GET['sellPrice'] > 0){
        $sellPrice = $_GET['sellPrice'];
    }else{
        $sellPrice = $article->getSellingPrice();
    }
        
    if(!empty($_GET['unit']) && $_GET['unit'] != null && $_GET['unit'] != ""){
        $unit = $_GET['unit'];
    }else{
        $unit = $article->getUnit();
    }
    
    if(!empty($_GET['packUnit']) && $_GET['packUnit'] != null && $_GET['packUnit'] != ""){
        $packUnit = $_GET['packUnit'];
    }else{
        $packUnit = $article->getPackingUnit();
    }
    
    if(!empty($_GET['packSize']) && $_GET['packSize'] != null && $_GET['packSize'] != 0){
        $packSize = $_GET['packSize'];
    }else{
        $packSize = $article->getPackingSize();
    }
    
    if(!empty($_GET['minStock']) && $_GET['minStock'] != null && $_GET['minStock'] > 0){
        $min = $_GET['minStock'];
    }else{
        $min = $article->getMinimumLevel();
    }
    
    if(!empty($_GET['vendor']) && $_GET['vendor'] != null && $_GET['vendor'] != 0){
        $vendor = $_GET['vendor'];
    }else{
        $vendor = $article->getVendor();
    }
    
    if(!empty($_GET['surcharge']) && $_GET['surcharge'] != null){
        $surcharge = $_GET['surcharge'];
    }else{
        $surcharge = $article->getSurcharge();
    }

    $article->setArticle($desc, $group, $buyPrice, $sellPrice, $unit, $packUnit, $packSize, $min, $vendor, $surcharge);
}