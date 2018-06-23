<div class="container-fluid">
    <div class="row" style="margin: 15px !important">
        <a href="http://localhost/CompuTech/frontend/?menu=order&type=new"><button class="btn btn-primary">Neu</button></a>
    </div>
<?php
$db = new PurchaseOrderDAO();
$purchaseOrders = $db->getAllPurchaseOrder();
echo "<table class='table'>";
echo "<tr>";
echo "<th>Nummer</th>";
echo "<th>Lieferant</th>";
echo "<th>Datum</th>";
echo "<th>Angebotsnummer</th>";
echo "<th>Status</th>";
echo "<th></th>";
echo "</tr>";
foreach ($purchaseOrders as $value) {
    echo "<form method='POST' action='http://localhost/CompuTech/frontend/?menu=order'>";
    echo "<input type='text' name='orderNum' style='display: none' value='".$value->getNum()."'>";
    echo "<tr>";
    echo "<td>" . $value->getNum() . "</td>";
    echo "<td>" . $value->getParty() . "</td>";
    echo "<td>" . $value->getOrderDate() . "</td>";
    echo "<td>" . $value->getOfferNumber() . "</td>";
    echo "<td>" . $value->getOrderStatus() . "</td>";
    echo "<td><button type='submit' class='btn btn-primary'>Bearbeiten</button></td>";
    echo "</tr>";
    echo "</form>";
}

echo "</table>";
?>

</div>