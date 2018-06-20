<?php
include_once $_SERVER['DOCUMENT_ROOT'].'//computech/frontend/includes.php';
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 15.06.2018
 * Time: 06:45
 */
?>

<script type="text/javascript">
    function Change(dest) {
        document.location.href = dest;
    }
</script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
      integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<div class="container">
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand" href="/frontend/WarehouseHome.php">Computech Lager</a>
        <a class="btn btn-outline-secondary my-2 my-sm-0" href="/computech/frontend/WarehouseHome.php">Home</a>
    </nav>
</div>
<div style="height: 25px;"></div>

<?php
if(!isset($_GET["page"])){
?>

<div class="container">
    <div class="card-deck" style="color: black; text-decoration: none;">
        <div class="card bg-light" onclick="Change('/frontend/WarehouseHome.php?page=goodsReceipt')" style="cursor: pointer;">
            <div class="card-header">Wareneingang</div>
            <img class="card-img-top" style="height: 100px; width:100px; align-self: center; margin-top: 15px;" src="Img/003-truck.png" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Hier können Sie Ihre Wareneingänge erfassen und verbuchen.</p>
            </div>
        </div>
        <div class="card bg-light" onclick="Change('/frontend/WarehouseHome.php?page=articleStock')" style="cursor: pointer;">
            <div class="card-header">Lagerplatzkontrolle</div>
            <img class="card-img-top" style="height: 100px; width:100px; align-self: center; margin-top: 15px;" src="Img/001-stock.png" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Hier erhalten Sie auskünfte über den aktuellen Lagerstand pro Artikel und Lagerplatz.</p>
            </div>
        </div>
        <div class="card bg-light"  onclick="Change('/frontend/WarehouseHome.php?page=picking')" style="cursor: pointer;">
            <div class="card-header">Pickliste</div>
            <img class="card-img-top" style="height: 100px; width:100px; align-self: center; margin-top: 15px;" src="Img/002-list.png" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Hier können Sie Picklisten für den Warenausgang hinterlegen.</p>
            </div>
        </div>
        <div class="card bg-light" onclick="Change('/frontend/WarehouseHome.php?page=goodsIssue')" style="cursor: pointer;">
            <div class="card-header">Warenausgang</div>
            <img class="card-img-top" style="height: 100px; width:100px; align-self: center; margin-top: 15px;" src="Img/004-box.png" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Hier können Sie Ihre Warenausgänge erfassen und verbuchen.</p>
            </div>
        </div>
    </div>
</div>

<?php
}elseif ($_GET["page"] == "goodsReceipt"){

}elseif ($_GET["page"] == "articleStock"){
    include "controller/articleStockController.php";
}elseif ($_GET["page"] == "picking"){
    include "controller/orderPickingController.php";
}elseif ($_GET["page"] == "goodsIssue"){
    include "controller/goodsIssueController.php";
}

?>
