<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 09.06.2018
 * Time: 16:59
 */

class OrderArticleDAO
{

    function createOrderArticle($articleID, $orderID, $quantity, $price)
    {



        $this->doConnect();
        $call = $this->conn->prepare("INSERT INTO ORDERARTICLE (ID, ArticleID,OrderID,QuantityOrdered,Price) VALUES(null,s,s,s,s)");
        $call->bind_param('ssss', $articleID, $orderID, $quantity, $price);
        $call->execute();
    }

}