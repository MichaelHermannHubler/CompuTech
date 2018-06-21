<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 09.06.2018
 * Time: 16:51
 */


class OrderDAO extends AbstractDAO
{


    function createOrder($number)
    {



        $this->doConnect();
        $call = $this->conn->prepare("INSERT INTO `order`(Number) VALUE (?)");
        $call->bind_param('s', $number);

        //$stmt = $this->conn->prepare("insert into user (Username, PasswortMD5, FirstName, LastName) values(?,?,?,?)");
        //$stmt->bind_param("ssss", $user, $pw, $first, $last);


        $call->execute();

        $call->fetch();

        $last_id= $call->insert_id;
        echo "Last Call ID Order:".$last_id;
        $order = new Order($last_id, $number);

        return $order;



    }


}