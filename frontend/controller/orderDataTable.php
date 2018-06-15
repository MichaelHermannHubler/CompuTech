<?php

include_once '../../persistance/dao/dao_purchase/OfferOrderDAO.php';
$db = new OfferOrderDAO();
$offerOrders = $db->getAllOfferOrder();
echo "<table>";
echo "<tr>";
echo "<th>Price</th>";
echo "</tr>";
foreach ($offerOrders as $offerOrder) {
    echo"<tr>";
    echo "<td>" . $offerOrders->getNum() . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "<span>test</span>";