<?php
/*
 * user: weissn
 */

if(!empty($_GET['success'])){
    echo "<h4 style='background-color: LightBlue; margin: 10px 0px; line-height: 40px;'>Bestellung wurde erstellt!</h4>";
}

include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/frontend/includes.php';

if (empty($_POST['orderNum']) && empty($_GET['type'])) {
    $new = false;
    include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/frontend/controller/purchaseOrderDataTable.php';
} else if (empty($_POST['orderNum']) && !empty($_GET['type'])) {
    $new = true;
    include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/frontend/controller/purchaseOrderNewAndEdit.php';
} else {
    $new = false;
    include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/frontend/controller/purchaseOrderNewAndEdit.php';
}
?>
