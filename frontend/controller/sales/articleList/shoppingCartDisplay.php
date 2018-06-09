<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 04.06.2018
 * Time: 16:07
 */

include $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/controller/sales/articleList/shoppingCartController.php';


echo "<table>";
$firstRow = true;

foreach ($_SESSION['articleList'] as $item){

    if ($firstRow){

        echo "<table><tr><th>ID</th><th>Name</th><th>Retail Price</th><th>Aktionen</th></tr>";
        $firstRow = false;
    }

    if ($item->getAmount() > 0){
        echo '<tr>';

        echo '<td>';
        $id = $item->getArticleId();
        echo $id;
        echo '</td>';

        echo '<td>';
        echo $item->getArticleDesc();
        echo '</td>';

        echo '<td>';
        echo $item->getAmount();
        echo '</td>';

        echo '<td>';
        echo '<form method="get">';
        echo '<input type="hidden" name="articleIdToDelete"  value="'.$id.'"/>';
        echo '<input type="submit" value="loeschen" >';
        echo '</form>';

        echo '<form method="get">';
        echo '<input type="hidden" name="articleIdToAdd"  value="'.$id.'"/>';
        echo '<input type="hidden" name="desc"  value="'.$item->getArticleDesc().'"/>';
        echo '<input type="hidden" name="price"  value="'.$item->getPrice().'"/>';
        echo '<input type="submit" value="Hinzufügen" name="add">';
        echo '</form>';

        echo '</td>';


        echo '</tr>';

    }



}



echo "</table>";
