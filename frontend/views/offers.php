<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/includes.php';
?>
<a href="./controller/offerController.php"><button>Neues Angebot</button></a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Angebotsnummer</th>
            <th>Lieferant</th>
            <th>Erstelldatum</th>
            <th>Gesamtpreis</th>
            <th>Detailansicht</th>
        </tr>
    </thead>
    <tbody>
<?php
$db = new OfferOrderDAO;
$alleOffer = $db->getAllOfferOrder();
$vendor = new SupplierDAO;
for ($i = 0; $i < count($alleOffer); $i++) {
    $supplier = $vendor->getSupplier($alleOffer[$i]->getParty());
    $supplierName = utf8_encode($supplier->getName());
    $num = $alleOffer[$i]->getNum();
    echo"<tr>";
    echo "<div class=\"article\">";
    echo "<td>$num</td>";
    echo "<td>" . $supplierName . "</td>";
    echo "<td>" . $alleOffer[$i]->getCreateDate() . "</td>";
    echo "<td>" . $alleOffer[$i]->getTotal(($num-1000)) . "</td>";
    echo "<td><a href=\"./controller/offerDetailController.php?Num=$num\"><button>Detailansicht</button></a></td>";
    echo "</div>";
    echo"</tr>";
}
?>
    </tbody>
</table>
