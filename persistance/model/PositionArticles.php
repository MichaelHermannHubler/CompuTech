<?php
include './Article.php';
include '../dao/dao_purchase/OfferOrderDAO.php';
include '../dao/dao_purchase/ArticleDAO.php';
Class PositionArticles {

    private $articleNumber;
    private $price;
    private $quantity;
    private $refereceNumber;

    function __construct($num, $price, $quantity, $refNum) {
        $this->articleNumber = $num;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->refereceNumber = $refNum;
    }

    function getArticleNumber() {
        return $this->articleNumber;
    }

    function getPrice() {
        return $this->price;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getReferceNumber() {
        return $this->refereceNumber;
    }

    function setPositionArticlesOffer($article) {
        if ($article instanceof Article) {
            if ($this->articleNumber == $article->getArticleNumber()) {
                if ($article->getPrice() > 0) {
                    $this->price = $article->getPrice();
                } else {
                    echo "Price should be higher than zero";
                }
                if ($article->getQuantity() > 0) {
                    $this->quantity = $article->getQuantity();
                } else {
                    echo "Quantity should be higher than zero";
                }
            } else {
                echo "Wrong articleNumber inserted.";
            }
        } else {
            echo "Please insert an Article Object.;";
        }
        
        
        
        $db = new ArticleDAO;
        $vendor = $db->getVendor($this->articleNumber);
        
        $db2 = new OfferOrderDAO;
        $this->refereceNumber = $db2->getAvailableOffer($vendor);
        
        

        //to do DB set
    }

    function setPositionArticlesPurchaseOrder($article) {
        if ($article instanceof Article) {
            if ($this->articleNumber == $article->getArticleNumber()) {
                if ($article->getQuantity() > 0) {
                    $this->quantity = $article->getQuantity();
                } else {
                    echo "Quantity should be higher than zero";
                }
            } else {
                echo "Wrong articleNumber inserted.";
            }
        } else {
            echo "Please insert an Article Object.;";
        }
        $db = new PurchasOrderDAO;
        
        $db2 = new ArticleDAO;
        $vendor = $db2->getVendor($this->articleNumber);
        
        $this->refereceNumber = $db->getUnorderedPurchaseOrder($vendor);
        
     
        //to do DB set mit Article und Vendor
    }

}
