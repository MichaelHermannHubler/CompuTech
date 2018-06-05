<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 04.06.2018
 * Time: 16:07
 */

include '../loginController.php';
include_once './articleListDisplay.php';


echo "<table>";

foreach ($_SESSION['articleList'] as $item){
    echo '<tr>';

    echo '<td>';
     echo $item->getArticleId();
    echo '</td>';

    echo '<td>';
     echo $item->getArticleDesc();
    echo '</td>';

    echo '<td>';
     echo $item->getAmount();
    echo '</td>';

    echo '<td>';
    echo '<form enctype="multipart/form-data" method="post">';
    echo '<input type="hidden" name="articleIdToDelete"  value="';
    echo $item->getArtikelId();
    echo '"/>';
    echo '<input type="submit" value="loeschen" >';
    echo 'Löschen';
    echo '</button>';

    echo '</td>';


    echo '</tr>';


}



echo "</table>";
