<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    

}

include_once $_SERVER['DOCUMENT_ROOT'].'/computech/frontend/includes.php';
$db = new ArticleDAO;
$stock = $db->getStockList();
$vendor = new SupplierDAO;

?>
<div class="container-fluid">
    <div class="row" style="margin: 15px !important">
        <a href="./controller/articleController.php"><button class="btn btn-primary"> Neuer Artikel</button></a>
    </div>
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
                echo "<td style=\"text-align: right;\">" . $stock[$i]->getBuyingPrice() . "</td>";
                echo "<td style=\"text-align: right;\">" . $stock[$i]->getSellingPrice() . "</td>";
                echo "<td>" . $stock[$i]->getUnit() . "</td>";
                echo "<td>" . $stock[$i]->getPackingUnit() . "</td>";
                echo "<td>" . $stock[$i]->getPackingSize() . "</td>";
                echo "<td>" . $stock[$i]->getMinimumStockLevel() . "</td>";
                echo "<td>$supplierName</td>";
                echo "<td><a href=\"./controller/articleController.php?articleNum=$articleNumber\"><button class='btn btn-primary'>Bearbeiten</button></a></td>";
                echo "</div>";
                echo"</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
