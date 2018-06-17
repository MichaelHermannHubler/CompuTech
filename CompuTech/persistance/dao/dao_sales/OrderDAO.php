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
        $call = $this->conn->prepare("INSERT INTO ORDER (ID, Number) VALUES(null,s)");
        $call->bind_param('s', $number);
        $call->execute();
        $last_id= $call->insert_id;

        $call->fetch();
        $order = new Order($last_id, $number);

        return $order;



    }


}