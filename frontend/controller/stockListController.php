<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/frontend/includes.php';
$db = new ArticleDAO;
$stock = $db->getStockList();
$vendor = new SupplierDAO;
?>
<button class="NewArticle"><a href="./controller/articleController.php">Neuer Artikel</a></button>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Artikelnummer</th>
            <th>Artikelbeschreibung</th>
            <th>Einkaufspreis</th>
            <th>Verkaufspreis</th>
            <th>Basiseinheit</th>
            <th>Verpackungseinheit</th>
            <th>Verpackungsgröße</th>
            <th>Mindestbestand</th>
            <th>Lieferant</th>
            <th>Bearbeiten</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 0; $i < count($stock); $i++) {
            $supplier = $vendor->getSupplier($stock[$i]->getVendor());
            $articleNumber = $stock[$i]->getArticleNumber();
            $articleDesc = utf8_encode($stock[$i]->getArticleDesc());
            $supplierName = utf8_encode($supplier->getName());
            echo"<tr>";
            echo "<div class=\"article\">";
            echo"<td>" . $stock[$i]->getArticleNumber() . "</td>";
            echo "<td>$articleDesc</td>";
            echo "<td>" . $stock[$i]->getBuyingPrice() . "</td>";
            echo "<td>" . $stock[$i]->getSellingPrice() . "</td>";
            echo "<td>" . $stock[$i]->getUnit() . "</td>";
            echo "<td>" . $stock[$i]->getPackingUnit() . "</td>";
            echo "<td>" . $stock[$i]->getPackingSize() . "</td>";
            echo "<td>" . $stock[$i]->getMinimumLevel() . "</td>";
            echo "<td>$supplierName</td>";
            echo "<td><button><a href=\"./controller/articleController.php?articleNum=$articleNumber\">Bearbeiten</a></button></td>";
            echo "</div>";
            echo"</tr>";
        }
        ?>
    </tbody>
</table>

