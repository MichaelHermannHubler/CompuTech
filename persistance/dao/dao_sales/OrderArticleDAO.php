<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 09.06.2018
 * Time: 16:59
 */

class OrderArticleDAO extends AbstractDAO
{

    function createOrderArticle($articleID, $orderID, $quantity, $price)
    {



        $this->doConnect();
        echo "Art:".$articleID;
        echo "Order:".$orderID;
        echo "Q:".$quantity;
        echo "p:".$price;
        $call = $this->conn->prepare("INSERT INTO `orderarticle` (`ArticleID`, `OrderID`, `QuantityOrdered`, `Price`) VALUES(?,?,?,?)");
        $call->bind_param('iiid', $articleID, $orderID, $quantity, $price);
        $call->execute();
    }

}