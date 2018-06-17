<?php

Class OfferArticles {

    private $articleNumber;
    private $price;
    private $quantity;
    private $refereceNumber;

    function __construct($articleNum, $price, $quantity, $refNum) {
        $this->articleNumber = $articleNum;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->refereceNumber = $refNum;
        
      //  $this->setOfferArticlesOffer($articleNum, $refNum, $price, $quantity);
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

    function setOfferArticlesOffer($articleNum, $ref, $price, $quant) {

        $this->articleNumber = $articleNum;
        
        $this->refereceNumber = $ref;
        
        $this->price = $price;

        $this->quantity = $quant;
        
  
        $offerArticleDAO = new OfferArticleDAO;
        
        $offerArticleDAO->setOfferArticle($this->articleNumber, $this->refereceNumber, $this->price, $this->quantity);
    }
/*
    function setOfferArticlesPurchaseOrder($article) {
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
*/
}
