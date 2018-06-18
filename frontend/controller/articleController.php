<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/includes.php';

if (!empty($_GET['articleNum'])) {

    $_SESSION['articleNum'] = $_GET['articleNum'];

    $db = new ArticleDAO;
    $article = $db->getArticle($_SESSION['articleNum']);
    $vendorDAO = new SupplierDAO;
    $vendor = $vendorDAO->getSupplier($article->getVendor());
    $vendorName = utf8_encode($vendor->getName());
    $articleGroup = utf8_encode($article->getArticleGroup());
    $articleDescription = utf8_encode($article->getArticleDesc());
} else {
    $new = true;
}
?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<form method='POST' action="ArticleFormHandler.php">
    <table  class="table table-bordered table-hover">
        <tr>
            <th>Bezeichnung</th>
            <th>Wert</th>
        </tr>
        <tr>
            <td>Artikelname</td>
            <td> <input type='text' name='name' value="<?php
                if (empty($new)) {
                    echo $articleDescription;
                }
                ?>" required></td>
        </tr>
        <tr>
            <td>Einkaufspreis</td>
            <td><input type='text' name='buyPrice' value="<?php
                if (empty($new)) {
                    echo $article->getBuyingPrice();
                }
                ?>" required></td>
        </tr>
        <tr>
            <td>Verkaufspreis</td>
            <td><input type="text" name="sellPrice" value="<?php
                if (empty($new)) {
                    echo $article->getSellingPrice();
                }
                ?>"></td>
        </tr>
        <tr>
            <td>Basiseinheit</td>
            <td><input type="text" name="unit" value="<?php
                if (empty($new)) {
                    echo $article->getUnit();
                }
                ?>" required></td>
        </tr>
        <tr>
            <td>Verpackungseinheit</td>
            <td><input type="text" name="packUnit" value="<?php
                if (empty($new)) {
                    echo $article->getPackingUnit();
                }
                ?>"></td>
        </tr>
        <tr>
            <td>Verpackungsgr&ouml;&szlig;e</td>
            <td><input type="text" name="packSize" value="<?php
                if (empty($new)) {
                    echo $article->getPackingSize();
                }
                ?>"></td>
        </tr>
        <tr>
            <td>Mindestbestand</td>
            <td><input type="text" name="minStock" value="<?php
                if (empty($new)) {
                    echo $article->getMinimumStockLevel();
                }
                ?>" required> </td>
        </tr>
        <tr>
            <td>Margenaufschlag</td>
            <td><input type="text" name="surcharge" value="<?php
                if (empty($new)) {
                    echo $article->getSurcharge();
                }
                ?>"></td>
        </tr>
        <tr>
            <td>Lieferant</td>
            <td>
                <select name="vendor">                       
                    <?php
                    $vendordb = new SupplierDAO;

                    $vendors = $vendordb->getSupplierStock();
                    if (empty($new)) {
                        echo "<option name=" . $article->getVendor() . ">";
                        echo $vendorName;
                        echo "</option>";
                    } else {
                        for ($i = 0; $i < count($vendors); $i++) {
                            $name = utf8_encode($vendors[$i]->getName());
                            echo "<option name=" . $vendors[$i]->getId() . ">";
                            echo $name;
                            echo "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Artikelgruppe</td>
            <td>
                <select name="group">
                    <?php
                    $db = new ArticleGroupDAO;

                    $groups = $db->getAllArtikleGroup();
                    if (empty($new)) {
                        echo "<option name=" . $article->getArticleGroup() . ">";
                        echo $articleGroup;
                        echo "</option>";
                    } else {
                        for ($i = 0; $i < count($groups); $i++) {
                            $name = utf8_encode($groups[$i]->getName());
                            echo "<option name=" . $groups[$i]->getId() . ">";
                            echo $name;
                            echo "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <?php
        if (empty($new)) {
            echo "<tr>";
            echo"<td>";
            echo"<div class=\"form-group form-check\">";
            echo"<input type=\"checkbox\" class=\"form-check-input\" id=\"delete\" name=\"delete\">";
            echo"<label class=\"form-check-label\" for=\"delete\" >Deaktivieren</label>";
            echo"</div>";
            echo"</td>";
            echo"<td></td>";
            echo"</tr>";
        }
        ?>
        <tr>
            <td>
                <?php
                if (!empty($new) && $new) {
                    echo " <button type='submit' class=\"btn btn-primary\" name=\"subNewArticle\" value=1>Eintragen</button>";
                } else {
                    echo " <button type='submit' class=\"btn btn-primary\" name=\"modArticle\" value=1>Eintragen</button>";
                }
                ?>
            </td>
            <td></td>
        </tr>
    </table>
</form>
