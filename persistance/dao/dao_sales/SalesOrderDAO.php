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

    function getPrice($id){
        $sum = null;
        $this->doConnect();
        $call = $this->conn->prepare("SELECT  SUM(oa.Price * oa.QuantityOrdered) AS 'PRICE PER ORDER'
                                            FROM salesorder so
                                              JOIN `order` o
                                                ON o.ID = so.OrderID
                                              JOIN orderarticle oa
                                                ON oa.OrderID = o.ID
                                            WHERE so.ID = ?");
        $call->bind_param('i', $id);
        $call->execute();
        $call->bind_result($sum);
        $call->fetch();
        $this->closeConnect();
        return $sum;
    }

    function getAllSalesOrders()
    {
        $this->doConnect();

        $stmt = $this->conn->prepare(
            "SELECT salesorder.ID, FirstName, LastName, Street, PostalCode, City, SysDateCreated, paid 
             FROM salesorder LEFT JOIN user ON salesorder.CustomerID=user.ID 
                             LEFT JOIN address ON salesorder.InvoiceAddressID=address.ID");

        $stmt->execute();

        $result = $stmt->get_result();

        while ($sO = $result->fetch_assoc()) {
            $salesOrder = new SalesOrder($sO['ID'],
                                            $sO['FirstName'],
                                            $sO['LastName'],
                                            $sO['Street'],
                                            $sO['PostalCode'],
                                            $sO['City'],
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
            "SELECT salesorder.ID, FirstName, LastName, Street, PostalCode, City, SysDateCreated, paid 
             FROM salesorder LEFT JOIN user ON salesorder.CustomerID=user.ID 
                             LEFT JOIN address ON salesorder.InvoiceAddressID=address.ID 
             WHERE paid=0");

        $stmt->execute();

        $result = $stmt->get_result();

        while ($sO = $result->fetch_assoc()) {
            $salesOrder = new SalesOrder($sO['ID'],
                $sO['FirstName'],
                $sO['LastName'],
                $sO['Street'],
                $sO['PostalCode'],
                $sO['City'],
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
        $stmt = $this->conn->prepare("UPDATE salesorder SET paid=1 WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->closeConnect();
    }

    function createBill($addressV, $addressR, $orderID, $userID){
        $this->doConnect();

        $call = $this->conn->prepare("INSERT INTO `salesorder`(`CustomerID`, `DeliveryAddressID`, `InvoiceAddressID`, `SysDateCreated`, `OrderID`) VALUES (?,?,?,NOW(),?)");
        $call->bind_param('iiii',$userID, $addressV, $addressR, $orderID);


        $call->execute();
        $call->fetch();


        $this->closeConnect();

    }

}

?>
