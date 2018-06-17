<?php
/**
 * Created by PhpStorm.
 * User: shu
 * Date: 17.06.2018
 * Time: 16:49
 */

class SalesOrderDAO extends AbstractDAO {

 public function __construct() {

}

function getAllSalesOrders() {
    $this->doConnect();
    $stmt = $this->conn->prepare("select salesorder.ID, FirstName, LastName, Street, PostalCode, City, QuantityOrdered*Price AS Total, SysDateCreated from salesorder join user on salesorder.CustomerID = user.ID join address on salesorder.InvoiceAddressID = address.ID join order on salesorder.ID = order.ID join orderarticle on order.ID = orderarticle.ID;");
    $stmt->execute();
    if ($stmt->num_rows > 0) {
        echo "<table>";
        echo "<tr><td>Rechnungsnummer</td><td>Kunde</td><td>Adresse</td><td>Rechnungsbetrag</td><td>Rechnungsdatum</td><td>Rechnung bezahlt?</td></tr>";
        //$items = array();
        while ($row = $stmt->mysqli_fetch_array()) {
            echo "<tr><td>" . $row["salesorder.ID"] . "</td><td>" . $row["FirstName"] . " " . $row["LastName"] . "</td><td>" . $row["Street"] . ", " . $row["PostalCode"] . " " . $row["City"] . "</td><td>" . $row["Total"] . "</td><td>" . $row["SysDateCreated"];
            echo "<input type='checkbox' id='check' name='check' /></tr>";
        }
    }
}

function getOpenSalesOrders() {
    $this->doConnect();
//field OrderPaid does not exist yet -> create in DB
    $stmt = $this->conn->prepare("select salesorder.ID, FirstName, LastName, Street, PostalCode, City, QuantityOrdered*Price AS Total, SysDateCreated from salesorder join user on salesorder.CustomerID = user.ID join address on salesorder.InvoiceAddressID = address.ID join order on salesorder.ID = order.ID join orderarticle on order.ID = orderarticle.ID where paid = 0;");
    $stmt->execute();
    if ($stmt->num_rows > 0) {
        echo "<table>";
        echo "<tr><td>Rechnungsnummer</td><td>Kunde</td><td>Adresse</td><td>Rechnungsbetrag</td><td>Rechnungsdatum</td><td>Rechnung bezahlt?</td></tr>";
        $items = array();
        while ($row = $stmt->mysqli_fetch_array($stmt)) {
            echo "<tr><td>" . $row["salesorder.ID"] . "</td><td>" . $row["FirstName"] . " " . $row["LastName"] . "</td><td>" . $row["Street"] . ", " . $row["PostalCode"] . " " . $row["City"] . "</td><td>" . $row["Total"] . "</td><td>" . $row["SysDateCreated"];
            echo "<input type='checkbox' id='check' name='check' /></tr>";
        }
    }
}
}
?>
