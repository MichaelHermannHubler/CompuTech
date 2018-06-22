<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/persistance/dao/dao_sales/SalesOrderDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/persistance/model/SalesOrder.php';

if (isset($_POST['saveChanges'])) {
    $id = $_POST['id'];
    $update = new SalesOrderDAO();
    $update->setPaid($id);
}
?>

<form action="salesOrderTypeController.php" method="post">
	<button type="submit" name="allOrders">Alle Rechnungen anzeigen</button>
	<button type="submit" name="openOrders">Offene Rechnungen anzeigen</button>
</form>

<?php
if (isset($_POST['saveChanges'])) {

    echo "<div class='alert alert-success' role='alert'>";
    echo "Bezahlstatus erfolgreich upgedated";
	echo "</div>";
}

if (isset($_POST["allOrders"])) {
    echo "<h1>Rechungsübersicht</h1>";
    echo "<table class='table table-hover'>";
    echo "<tr><td>Rechnungs-ID</td><td>Kunde</td><td>Adresse</td><td>Rechnungsdatum</td><td>Betrag</td><td>Rechnung bezahlt?</td></tr>";
    $recs = new SalesOrderDAO();
    $allRecs = $recs->getAllSalesOrders();
    //var_dump($allRecs);
    foreach ($allRecs as $rec) {
        echo "<tr>";
        echo "<td>" . $rec->getId() . "</td>";
        echo "<td>" . $rec->getFirst() . " " . $rec->getLast() . "</td>";
        echo "<td>" . $rec->getStreet() . ", " . $rec->getPostal() . " " . $rec->getCity() . "</td>";

        $date1 = strtotime($rec->getDateCreated());
        $date2 = strtotime("now");
        $diff = $date2 - $date1;
        $days = floor($diff / 86400);
        if ($rec->getPaid() <> 1 && $days > 30) {
            echo "<td class='danger'>" . $rec->getDateCreated() . "</td>";
        } elseif ($rec->getPaid() <> 1 && $days > 13 && $days < 31) {
            echo "<td class='warning'>" . $rec->getDateCreated() . "</td>";
        } else {
            echo "<td>" . $rec->getDateCreated() . "</td>";
        }

        echo "<td>" . $recs->getPrice($rec->getId()) . "</td>";

        if ($rec->getPaid() <> 1) {
            echo "<td><input disabled='true' type='checkbox' name='paid' /></td>";
        } else {
            echo "<td><input disabled='true' type='checkbox' name='paid' checked /></td>";
        }

        $id = $rec->getId();

        echo "</tr>";
    }
    echo "</table>";
} elseif (isset($_POST["openOrders"])) {
    echo "<h1 id='up'>Rechungsübersicht</h1>";
    echo "<table class='table table-hover'>";
    echo "<tr><td>Rechnungs-ID</td><td>Kunde</td><td>Adresse</td><td>Rechnungsdatum</td><td>Betrag</td><td>Rechnung bezahlt?</td><td>Bezahlstatus</td></tr>";
    $recs = new SalesOrderDAO();
    $openRecs = $recs->getOpenSalesOrders();
    //var_dump($openRecs);
    foreach ((array)$openRecs as $rec) {
        echo "<tr>";
        echo "<td>" . $rec->getId() . "</td>";
        echo "<td>" . $rec->getFirst() . " " . $rec->getLast() . "</td>";
        echo "<td>" . $rec->getStreet() . ", " . $rec->getPostal() . " " . $rec->getCity() . "</td>";

        $date1 = strtotime($rec->getDateCreated());
        $date2 = strtotime("now");
        $diff = $date2 - $date1;
        $days = floor($diff / 86400);
        if ($days > 30) {
            echo "<td class='danger'>" . $rec->getDateCreated() . "</td>";
        } elseif ($days > 13 && $days < 31) {
            echo "<td class='warning'>" . $rec->getDateCreated() . "</td>";
        } else {
            echo "<td>" . $rec->getDateCreated() . "</td>";
        }

        echo "<td>" . $recs->getPrice($rec->getId()) . "</td>";

        if ($rec->getPaid() <> 1) {
            echo "<td><input disabled='true' type='checkbox' name='paid' /></td>";
        } else {
            echo "<td><input disabled='true' type='checkbox' name='paid' checked /></td>";
        }

        $id = $rec->getId();
        echo "<form method='POST'>";
        echo "<input type='hidden' name='id' id='id' value='$id' />";
        echo "<input type='hidden' name='openOrders' id='openOrders' value='true' />";
        echo "<td><button type='submit' name='saveChanges' id='saveChanges'>als bezahlt hinterlegen</td>";
        echo "</tr>";
        echo "</form>";
    }
    echo "</table>";
}
?>
