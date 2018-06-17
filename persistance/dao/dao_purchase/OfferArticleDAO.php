<?php

Class OfferArticleDAO extends AbstractDAO {

    function __construct() {
        
    }

    function getOfferArticle($ref) {
        $this->doConnect();
        $stmt = $this->conn->prepare("select ArticleID, Quantity, Price from offerarticle where OfferID = ?");
        
        $stmt->bind_param("i", $ref);
        
        $stmt->execute();
        
        $stmt->bind_result($articleID, $quantity, $price);
        
        $offerArticles = array();
        
        while($stmt->fetch()){
            $OfferArticle = new OfferArticles($articleID, $price, $quantity, $ref);
            array_push($offerArticles, $OfferArticle);
        }

        $this->closeConnect();
        return $offerArticles;
    }

    function setOfferArticle($article, $ref, $price, $quant) {
        
        if($price == null){
            $price = 0;
        }

        
        if ($this->getOfferArticleFromOfferAndArticle($ref, $article) == true) {
            echo "up";
            $link = $this->doConnect();
            $query = "update offerarticle set Quantity = $quant, set Price = $price)";
            mysqli_query($this->conn, $query);
        } else {
            echo "ins";
            $link = $this->doConnect();
            $query = "insert into offerarticle (OfferID, ArticleID, Quantity, Price) values ($ref, $article, $quant, $price)";
            mysqli_query($this->conn, $query);
        }
        

        $this->closeConnect();
    }

    function getOfferArticleFromOfferAndArticle($ref, $article) {
        $this->doConnect();

        $exist = false;

        $stmt = $this->conn->prepare("Select ID from offerarticle where OfferID = ? and ArticleID = ?");

        $stmt->bind_param("ii", $ref, $article);

        $stmt->execute();

        if ($stmt->fetch()) {
            $exist = true;
        }

        $this->closeConnect();
        return $exist;
    }

}
