<?php

$db = new OfferOrderDAO();
$offerOrder = $db->getOfferOrderFromId($db->getOfferIDFromNumber($_GET['orderNum']));
echo "<table class='table'>";
echo "<tr>";
echo "<th>Nummer</th>";
echo "<th>Lieferant</th>";
echo "<th>Datum</th>";
echo "<th>Preis</th>";
echo "</tr>";
echo "<tr>";
echo "<td>" . $offerOrder->getNum() . "</td>";
echo "<td>" . $offerOrder->getParty() . "</td>";
echo "<td>" . $offerOrder->getCreateDate() . "</td>";
echo "<td>" . $offerOrder->getTotal() . "</td>";
echo "</tr>";
echo "</table>";
?>