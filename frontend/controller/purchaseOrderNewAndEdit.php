<style>
    .padded {
        padding: 20px;
    }
</style>

<?php
$newObject = true;
if (!empty($_POST['orderNum'])) {
    $purchaseOrderDAO = new PurchaseOrderDAO();
    $purchaseOrders = $purchaseOrderDAO->getPurchaseOrder($_POST['orderNum']);
    $purchaseOrder = $purchaseOrders[0];
}
?>

<div class="container-fluid">
    <div class="row">
        <div <?php
        if ($new) {
            echo 'class="col-md-6 padded"';
        } else {
            echo 'style="display: none"';
        }
        ?>>
            <h2>Bestellung basierend auf Angebot anlegen</h2>

            <form method='POST' action='./controller/purchaseOrderFormHandler.php' class="padded">
                <div class="form-group">
                    <label for="offer">Angebotsnummer</label>
                    <select id="offer" name="offer" class="form-control">
                        <option value="null">None</option>
                        <?php
                        $dbOffer = new OfferOrderDAO;
                        $orders = $dbOffer->getAllOfferOrder();

                        for ($i = 0; $i < count($orders); $i++) {
                            echo "<option value='" . $dbOffer->getOfferIDFromNumber($orders[$i]->getNum()) . "'>";
                            echo $orders[$i]->getNum();
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Erstellen</button>
            </form>

        </div>
        <div class="<?php
        if ($new) {
            echo 'col-md-6';
        } else {
            echo 'col-md-12';
        }
        ?> padded">
            <h2><?php
                if ($new) {
                    echo "Bestellung ohne Angebot anlegen";
                } else {
                    echo "Bestellung bearbeiten";
                }
                ?></h2>

            <form method='POST' action='./controller/purchaseOrderFormHandler.php<?php if(!$new){ echo "?edit=true"; } ?>' class="padded">
                <?php 
                if (!$new) {
                    echo "<input type='text' style='display: none' name='id' value='".$purchaseOrder->getNum()."'>";
                }
                ?>
                <div class="form-group">
                    <label for="supplier">Lieferant</label>
                    <select id="supplier" name="supplier" class="form-control">
                        <?php
                        $dbSupplier = new SupplierDAO;

                        $supplier = $dbSupplier->getSupplierStock();

                        for ($i = 0; $i < count($supplier); $i++) {
                            $suppId = $supplier[$i]->getId();
                            echo "<option value=" . $suppId;
                            if (!$new) {
                                if ($suppId == $dbSupplier->getSupplier($purchaseOrder->getParty())->getId()) {
                                    echo " selected";
                                }
                            }

                            echo ">";
                            echo $supplier[$i]->getName();
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="orderDate">Bestellungsdatum</label>
                    <input id='orderDate' name="orderDate" type='date' <?php
                    if (!$new) {
                        echo "value = '".date_format(date_create($purchaseOrder->getOrderDate()), 'Y-m-d')."'";
                    }
                    ?>>
                </div>
                <div class="form-group">
                    <label for="deliveryType">Lieferungsart</label>
                    <select id="deliveryType" name="deliveryType" class="form-control">
                        <option value="C">Komplett</option>
                        <option value="P">Teil</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Speichern</button>
            </form>
        </div>
    </div>
</div>