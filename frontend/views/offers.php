<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/frontend/includes.php';
$db = new OfferOrderDAO;
$alleOffer = $db->getAllOfferOrder();

?>
<button class="NewArticle"><a href="./controller/offerController.php">Neues Angebot</a></button>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Angebotsnummer</th>
            <th>Lieferant</th>
            <th>Erstelldatum</th>
            <th>Gesamtpreis</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 0; $i < count($alleOffer); $i++) {
            $supplier = $vendor->getSupplier($alleOffer[$i]->getVendor());
            $supplierName = utf8_encode($supplier->getName());
            
            echo"<tr>";
            echo "<div class=\"article\">";
            echo "<td>" . $alleOffer[$i]->getNum() . "</td>";
            echo "<td>" . $supplierName . "</td>";
            echo "<td>" . $alleOffer[$i]->getCreateDate() . "</td>";
            echo "<td>" . $alleOffer[$i]->getTotal() . "</td>";
            echo "</div>";
            echo"</tr>";
        }
        ?>
    </tbody>
</table>
