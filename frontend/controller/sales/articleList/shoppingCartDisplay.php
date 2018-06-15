<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 04.06.2018
 * Time: 16:07
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/controller/sales/articleList/shoppingCartController.php';


echo "<table>";
$firstRow = true;
$sum = 0;

foreach ($_SESSION['articleList'] as $item) {

    if ($firstRow) {

        echo "<table><tr><th>Name</th><th>Anzahl</th><th>Einkaufspreis</th><th>Aktionen</th></tr>";
        $firstRow = false;
    }

    if ($item->getAmount() > 0) {
        echo '<tr>';

        echo '<td>';
        $id = $item->getArticleId();
        echo $item->getArticleDesc();
        echo '</td>';

        echo '<td>';
        echo $item->getAmount();
        echo '</td>';

        echo '<td>';
        echo $item->getPrice();
        echo '</td>';

        $sum = $sum + ($item->getAmount() * $item->getPrice());
        if (isset($checkOut) && $checkOut) {
            //Dont display buttons

        } else {
            echo '<td>';
            echo '<form method="get">';
            echo '<input type="hidden" name="articleIdToDelete"  value="' . $id . '"/>';
            echo '<input type="submit" value="-" >';
            echo '</form>';

            echo '<form method="get">';
            echo '<input type="hidden" name="articleIdToAdd"  value="' . $id . '"/>';
            echo '<input type="hidden" name="desc"  value="' . $item->getArticleDesc() . '"/>';
            echo '<input type="hidden" name="price"  value="' . $item->getPrice() . '"/>';
            echo '<input type="submit" value="+" name="add">';
            echo '</form>';

            echo '</td>';

        }

        echo '</tr>';


    }


}


echo "</table>";

echo "<h2>Summe:" . $sum . "</h2>";
?>


<a href="../checkoutAdressController.php">Zur Kasse gehen</a>

