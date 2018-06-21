<?php
/**
 * Created by PhpStorm.
 * User: shu
 * Date: 17.06.2018
 * Time: 16:49
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/persistance/dao/AbstractDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/persistance/model/SalesOrder.php';

class SalesOrderDAO extends AbstractDAO
{
    protected $id;
    protected $firstn;
    protected $lastn;
    protected $street;
    protected $postal;
    protected $city;
    protected $dateCreated;
    protected $paid;
    private $salesOrders = array();

    public function __construct() {

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

        $stmt->execute();

        $result = $stmt->get_result();

        while ($sO = $result->fetch_assoc()) {
            $salesOrder = new SalesOrder($sO['ID'],
                                            $sO['FirstName'],
                                            $sO['LastName'],
                                            $sO['Street'],
                                            $sO['PostalCode'],
                                            $sO['City'], /*$total,*/
                                            $sO['SysDateCreated'],
                                            $sO['paid']);
            array_push($this->salesOrders, $salesOrder);
        }

        $stmt->free_result();
        $result->close();
        $this->closeConnect();

        return $this->salesOrders;
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

        $result = $stmt->get_result();

        while ($sO = $result->fetch_assoc()) {
            $salesOrder = new SalesOrder($sO['ID'],
                $sO['FirstName'],
                $sO['LastName'],
                $sO['Street'],
                $sO['PostalCode'],
                $sO['City'], /*$total,*/
                $sO['SysDateCreated'],
                $sO['paid']);
            array_push($this->salesOrders, $salesOrder);
        }

        $stmt->free_result();
        $result->close();
        $this->closeConnect();

        return $this->salesOrders;
    }

    function setPaid($id) {
        $this->doConnect();
        $stmt = $this->prepare("UPDATE salesorder SET paid=1 WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->closeConnect();
    }
}

?>
