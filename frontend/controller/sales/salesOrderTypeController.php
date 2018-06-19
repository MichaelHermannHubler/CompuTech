<!--/**
 * Created by PhpStorm.
 * User: shu
 * Date: 16.06.2018
 * Time: 12:57
 */-->
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTechX/persistance/dao/dao_sales/SalesOrderDAO.php';
?>

<form action="salesOrderTypeController.php" method="post">
    <button type="submit" name="allOrders">Alle Rechnungen anzeigen</button>
    <button type="submit" name="openOrders">Offene Rechnungen anzeigen</button>
</form>

<table>
    <tr><td>Rechnungsnummer</td><td>Kunde</td><td>Adresse</td><td>Rechnungsbetrag</td><td>Rechnungsdatum</td><td>Rechnung bezahlt?</td></tr>
    <?php
    if (isset($_POST["allOrders"])) {
        $recs = new SalesOrderDAO();
        $allRecs = $recs->getAllSalesOrders();
        foreach ($allRecs as $rec) {
            echo "<tr>";
            echo "<td>$rec->id</td>";
            echo "<td>$rec->firstn</td>";
            echo "<td>$rec->lastn</td>";
            echo "<td>$rec->street</td>";
            echo "<td>$rec->postal</td>";
            echo "<td>$rec->city</td>";
            echo "<td>$rec->dateCreated</td>";
            if ($rec->paid=1) {
                echo "<td><input type='checkbox' name='paid' value='checked' /></td>";
            } else {
                echo "<td><input type='checkbox' name='paid' /></td>";
            }
            echo "</tr>";
        }
    } elseif (isset($_POST["openOrders"])) {
        $recs = new SalesOrderDAO();
        $openRecs = $recs->getOpenSalesOrders();
        foreach ($openRecs as $rec) {
            echo "<tr>";
            echo "<td>$rec->id</td>";
            echo "<td>$rec->firstn</td>";
            echo "<td>$rec->lastn</td>";
            echo "<td>$rec->street</td>";
            echo "<td>$rec->postal</td>";
            echo "<td>$rec->city</td>";
            echo "<td>$rec->dateCreated</td>";
            if ($rec->paid=1) {
                echo "<td><input type='checkbox' name='paid' value='checked' /></td>";
            } else {
                echo "<td><input type='checkbox' name='paid' /></td>";
            }
            echo "</tr>";
    }
}

?>
</table>
