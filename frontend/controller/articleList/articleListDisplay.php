<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 04.06.2018
 * Time: 16:07
 */




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
    echo '<button>';
    echo 'Löschen';
    echo '</button>';

    echo '</td>';

    echo '<td>';

    echo '</td>';

    echo '</tr>';


}



echo "</table>";
