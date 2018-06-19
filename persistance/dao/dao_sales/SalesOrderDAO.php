<?php
/**
 * Created by PhpStorm.
 * User: shu
 * Date: 17.06.2018
 * Time: 16:49
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/persistance/dao/AbstractDAO.php';

class SalesOrderDAO extends AbstractDAO
{

    public function __construct()
    {

    }

    function getAllSalesOrders()
    {
        $this->doConnect();

        $stmt = $this->conn->prepare(
            "SELECT salesorder.ID, FirstName, LastName, Street, PostalCode, City, /*QuantityOrdered*Price AS Total,*/ SysDateCreated, paid 
             FROM salesorder LEFT JOIN user ON salesorder.CustomerID=user.ID 
                             LEFT JOIN address ON salesorder.InvoiceAddressID=address.ID 
                             /*LEFT JOIN order ON salesorder.ID=order.ID 
                             LEFT JOIN orderarticle ON order.ID=orderarticle.ID*/");
                            //not working with last two joins
        $stmt->execute();

        $stmt->bind_result($id, $firstn, $lastn, $street, $postal, $city/*, $total*/, $dateCreated, $paid);

        $salesOrders = array();
        //multidimensional array
        while ($stmt->fetch()) {
            $salesOrder = new SalesOrderDAO($id, $firstn, $lastn, $street, $postal, $city/*, $total*/, $dateCreated);
            array_push($salesOrders, $salesOrder);
        }

        $this->closeConnect();

        return $salesOrders;
    }

    function getOpenSalesOrders()
    {
        $this->doConnect();
        $stmt = $this->conn->prepare(
            "SELECT salesorder.ID, FirstName, LastName, Street, PostalCode, City, /*QuantityOrdered*Price AS Total,*/ SysDateCreated, paid 
             FROM salesorder LEFT JOIN user ON salesorder.CustomerID=user.ID 
                             LEFT JOIN address ON salesorder.InvoiceAddressID=address.ID 
                             /*LEFT JOIN order ON salesorder.ID=order.ID 
                             LEFT JOIN orderarticle ON order.ID=orderarticle.ID*/
             WHERE paid=0");

        $stmt->execute();

        $stmt->bind_result($id, $firstn, $lastn, $street, $postal, $city/*, $total*/, $dateCreated, $paid);

        $salesOrders = array();
        //multidimensional array
        while ($stmt->fetch()) {
            $salesOrder = new SalesOrderDAO($id, $firstn, $lastn, $street, $postal, $city/*, $total*/, $dateCreated);
            array_push($salesOrders, $salesOrder);
        }

        $this->closeConnect();

        return $salesOrders;
    }
}

?>
