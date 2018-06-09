<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 09.06.2018
 * Time: 16:51
 */
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/AbstractDAO.php';

class OrderDAO
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