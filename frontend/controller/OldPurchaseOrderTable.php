<?php

include_once '../../persistance/dao/dao_purchase/PurchaseOrderDAO.php';
$db = new PurchaseOrderDAO;
$order = $db->getPurchaseOrder($_SESSION['orderNum']);
echo "<table>";
echo "<tr>";
echo "<th>Bezeichnung</th>";
echo "<th>Wert</th>";
echo "</tr>";
echo"<tr>";
echo "<td>Alter Bestellnummer</td>";
echo "<td>".$order->getOfferNumber()."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Alte Artikelgruppe</td>";
echo "<td>".$order->getOrderStatus()."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Alter Einkaufspreis</td>";
echo "<td>".$order->getDeliveryType()."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Alter Verkaufspreis</td>";
echo "<td>".$order->getNum()."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Alte Basiseinheit</td>";
echo "<td>".$order->getParty()."</td>";
echo "</tr>";
echo "<tr>";
echo"<td>Alte Verpackungseinheit</td>";
echo "<td>".$order->getCreateDate()."</td>";
echo "</tr>";
echo "</table>";
