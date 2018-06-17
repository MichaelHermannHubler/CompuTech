<!--/**
 * Created by PhpStorm.
 * User: shu
 * Date: 16.06.2018
 * Time: 12:57
 */-->
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/persistance/dao/dao_sales/SalesOrderDAO.php';
?>

<form action="salesOrderTypeController.php" method="post">
    <button type="submit" name="allOrders">Alle Rechnungen anzeigen</button>
    <button type="submit" name="openOrders">Offene Rechnungen anzeigen</button>
</form>

<?php
if (isset($_POST["allOrders"])) {
    getAllSalesOrders();
} elseif (isset($_POST["openOrders"])) {
    getOpenSalesOrders();
}

?>
