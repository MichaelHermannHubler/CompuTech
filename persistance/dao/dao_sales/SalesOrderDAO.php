<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 17.06.2018
 * Time: 15:39
 */

class SalesOrderDAO extends AbstractDAO
{

    function createBill($addressV, $addressR, $orderID, $userID){
        $this->doConnect();

        $call = $this->conn->prepare("INSERT INTO `salesorder`(`CustomerID`, `DeliveryAddressID`, `InvoiceAddressID`, `SysDateCreated`, `OrderID`) VALUES (?,?,?,NOW(),?)");
        $call->bind_param('iiii',$userID, $addressV, $addressR, $orderID);


        $call->execute();
        $call->fetch();


        $this->closeConnect();

    }

}