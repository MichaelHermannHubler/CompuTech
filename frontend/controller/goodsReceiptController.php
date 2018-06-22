<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 10.06.2018
 * Time: 21:59
 */

include_once '../persistance/dao/AbstractDAO.php';
include_once '../persistance/dao/dao_purchase/ArticleGroupDAO.php';
include_once '../persistance/dao/dao_purchase/ArticleDAO.php';
include_once '../persistance/dao/dao_purchase/SupplierDAO.php';
include_once '../persistance/dao/dao_purchase/PurchaseOrderDAO.php';
include_once '../persistance/dao/AddressDAO.php';
include_once "../persistance/dao/dao_warehouse/WarehouseLocationDAO.php";
include_once '../persistance/model/Article.php';
include_once '../persistance/model/ArticleGroup.php';
include_once "../persistance/model/WarehouseLocation.php";
include_once '../persistance/model/Voucher.php';
include_once '../persistance/model/PurchaseOrder.php';
include_once '../persistance/model/Supplier.php';
include_once '../persistance/model/Address.php';

$purchaseOrderdb = new PurchaseOrderDAO();
$warehousedb = new WarehouseLocationDAO();
$cont = true;

?>

<style>
    .modal-backdrop {
        background-color: transparent;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('#exampleModal').on('shown.bs.modal', function () {
            $('#rack').prop('required', true);
            $('#position').prop('required', true);
            $('.custom-select').prop('required', false);
        })

        $('#exampleModal').on('hidden.bs.modal', function () {
            $('#rack').prop('required', false);
            $('#position').prop('required', false);
            $('.custom-select').prop('required', true);
        })

        $('#chooseOrder').on('click', function () {
            $('.custom-select').prop('required', false);
        })

        $('#addWarehouseLocation').on('click', function () {
            $('.custom-select').prop('required', false);
        })
    });
</script>

<div class="container">

    <?php
    if(isset($_GET["addWarehouseLocation"])){
        $rack = $_GET["rack"];
        $position = $_GET["position"];

        $warehousedb->addWarehouseLoation($rack, $position);
    }elseif (isset($_GET["save_all"])){

        $orderID = $_GET["orderhidden"];
        $complete = true;

        for($i = 0; $i < count($_GET["id"]); $i++){
            $id = $_GET["id"][$i];
            $quant = $_GET["quant"][$i];
            $warehouse = $_GET["warehouse"][$i];
            $defective = false;
            $ord = $_GET["ord"][$i];
            $delPrev = $_GET["delPrev"][$i];
            $article = $_GET["article"][$i];

            if(!in_array($i + 1, $_GET["defective"])) $defective = true;
            if($defective) $quant = 0;
            if($quant != $ord - $delPrev) $complete = false;


            $purchaseOrderdb->setPurchaseOrderArticle($id, $quant, $defective);
            $warehousedb->addStock($warehouse, $article, $quant);
        }

        if($complete){
            $cont = false;
            $purchaseOrderdb->setComplete($orderID, 'C');
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                Auftrag wurde erfolgreich abgeschlossen.
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            <?php
        }else{
            $purchaseOrderdb->setComplete($orderID, 'P');
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                Auftrag wurde erfolgreich gespeichert.
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            <?php
        }
    }

    $purchaseOrders = $purchaseOrderdb->getAllPurchaseOrder();
    ?>

    <form method="get">
        <input type="hidden" name="page" value="goodsReceipt">

        <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lagerplatz anlegen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="text" id="rack" name="rack" class="form-control" placeholder="Regal" aria-label="Username" aria-describedby="basic-addon1">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text" id="basic-addon3">-</span>
                            </div>
                            <input type="text" id="position" name="position" class="form-control" placeholder="Position" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                        <input type="submit" id="addWarehouseLocation" class="btn btn-primary" value="Hinzufügen" name="addWarehouseLocation">
                    </div>
                </div>
            </div>
        </div>

        <div class="input-group">
            <div class="input-group-prepend">
                <label class="input-group-text" for="picklist">Auftrag:</label>
            </div>
            <select class="custom-select" id="order" name="order">
                <option value="-1">Auftrag auswählen</option>
                <?php
                foreach ($purchaseOrders as $purchaseOrder) {
                    if ($purchaseOrder->getDeliveryType() != "C") {
                        ?>
                        <option
                                value="<?php echo $purchaseOrder->getNum(); ?>"
                            <?php if (isset($_GET["order"]) && $_GET["order"] == $purchaseOrder->getNum()) {
                                echo "selected";
                            } ?>
                        >
                            <?php echo $purchaseOrder->getNum(); ?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>
            <div class="input-group-append">
                <input type="submit" id="chooseOrder" class="btn btn-outline-secondary" value="Auswählen">
            </div>
        </div>
        <?php
            if($cont && isset($_GET["order"])){
                $articles = $purchaseOrderdb->getPurchaseOrderArticles($_GET["order"]);
                $articledb = new ArticleDAO();
                $warehousedb = new WarehouseLocationDAO();

                $warehouses = $warehousedb->getWarehouseLocations();

                ?>
                <div>
                    <input type="hidden" value="<?php echo $_GET["order"]; ?>" name="orderhidden">
                    <table class="table" id="returnTable">
                        <thead>
                        <tr>
                            <th>Artikelnummer</th>
                            <th>Menge</th>
                            <th>Lagerplatz</th>
                            <th>Ware OK</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        foreach ($articles as $value){
                            $article =      $value[0];
                            $id =           $value[1];
                            $quantityOrd =  $value[2];
                            $quantityDel =  $value[3];
                            $defective =    $value[4];

                            $defaultWarehouse = $articledb->getDefaultWarehouseLocation($article->getID());
                            ?>
                            <tr>
                                <input type="hidden" name="id[]" value="<?php echo $id; ?>">
                                <input type="hidden" name="ord[]" value="<?php echo $quantityOrd; ?>">
                                <input type="hidden" name="delPrev[]" value="<?php echo $quantityDel; ?>">
                                <input type="hidden" name="article[]" value="<?php echo $article->getID(); ?>">
                                <td><?php echo $article->getArticleNumber(); ?></td>
                                <td><input type="number" min="0" max="<?php echo $quantityOrd; ?>" name="quant[]" value="<?php echo $quantityOrd - $quantityDel; ?>"></td>
                                <td>
                                    <div class="input-group">
                                        <select class="custom-select" id="order" name="warehouse[]" required>
                                            <option value="">Lagerplatz auswählen</option>
                                            <?php
                                            foreach ($warehouses as $warehouse) {
                                                ?>
                                                <option
                                                    value="<?php echo $warehouse->getId(); ?>"
                                                    <?php
                                                    if (
                                                    (isset($defaultWarehouse) && $defaultWarehouse->getId() == $warehouse->getId())
                                                    ) {
                                                        echo "selected";
                                                    } ?>
                                                >
                                                    <?php echo $warehouse->getRack() . '-' . $warehouse->getPosition(); ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-secondary-outline" data-toggle="modal" data-target="#exampleModal">+</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <input
                                            type="checkbox"
                                        <?php if(!$defective) echo "checked"; ?>
                                            name="defective[]"
                                            value="<?php echo $id ?>"
                                    >
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <input type="submit" class="btn btn-outline-primary" value="Warenübernahme abschließen" name="save_all">
                </div>
                <?php
            }
        ?>
    </form>
</div>

