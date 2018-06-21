<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!--/**
 * Created by PhpStorm.
 * User: shu
 * Date: 16.06.2018
 * Time: 12:57
 */-->
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTechX/persistance/dao/dao_sales/SalesOrderDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTechX/persistance/model/SalesOrder.php';
?>

<form action="salesOrderTypeController.php" method="post">
    <button type="submit" name="allOrders">Alle Rechnungen anzeigen</button>
    <button type="submit" name="openOrders">Offene Rechnungen anzeigen</button>
</form>


    <?php
    if (isset($_POST["allOrders"])) {
        echo "<table class='table table-hover'>";
        echo "<tr><td>Rechnungs-ID</td><td>Kunde</td><td>Adresse</td><td>Rechnungsdatum</td><td>Rechnung bezahlt?</td></tr>";
        $recs = new SalesOrderDAO();
        $allRecs = $recs->getAllSalesOrders();
        //var_dump($allRecs);
        foreach ($allRecs as $rec) {
            echo "<tr>";
            echo "<td>" . $rec->getId() . "</td>";
            echo "<td>" . $rec->getFirst() . " " . $rec->getLast() . "</td>";
            echo "<td>" . $rec->getStreet() . ", " . $rec->getPostal() . " " . $rec->getCity() . "</td>";
            echo "<td>" . $rec->getDateCreated() . "</td>";

            if ($rec->getPaid() <> 1) {
                echo "<td><input type='checkbox' name='paid' /></td>";
            } else {
                echo "<td><input type='checkbox' name='paid' checked /></td>";
            }
            echo "</tr>";
        }
        ?>
        </table>
        <form action="salesOrderTypeController.php" method="post">
            <button type="submit" name="saveChanges">Änderungen speichern</button>
        </form>
        <?php
        if (isset($_POST['saveChanges'])) {

        }
    } elseif (isset($_POST["openOrders"])) {
        echo "<table class='table table-hover'>";
        echo "<tr><td>Rechnungs-ID</td><td>Kunde</td><td>Adresse</td><td>Rechnungsdatum</td><td>Rechnung bezahlt?</td></tr>";
        $recs = new SalesOrderDAO();
        $openRecs = $recs->getOpenSalesOrders();
        //var_dump($openRecs);
        foreach ((array) $openRecs as $rec) {
            echo "<tr>";
            echo "<td>" . $rec->getId() . "</td>";
            echo "<td>" . $rec->getFirst() . " " . $rec->getLast() . "</td>";
            echo "<td>" . $rec->getStreet() . ", " . $rec->getPostal() . " " . $rec->getCity() . "</td>";
            echo "<td>" . $rec->getDateCreated() . "</td>";

            if ($rec->getPaid() <> 1) {
                echo "<td><input type='checkbox' name='paid' /></td>";
            } else {
                echo "<td><input type='checkbox' name='paid' checked /></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
        <form action="salesOrderTypeController.php" method="post">
            <button type="submit" name="saveChanges">Änderungen speichern</button>
        </form>
        <?php
        if (isset($_POST['saveChanges'])) {

        }
    }
    ?>
