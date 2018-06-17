<?php
/*
 * user: weissn
 */

if(!empty($_GET['success'])){
    echo "<h4 style='background-color: LightBlue'>Bestellung wurde erstellt!</h4>";
}

include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/frontend/includes.php';

if (!empty($_SESSION['orderNum']) || !empty($_GET['orderNum'])) {

    if (empty($_SESSION['orderNum'])) {
        $_SESSION['orderNum'] = $_GET['orderNum'];
    }
    include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/frontend/controller/orderDataTable.php';
    $new = false;
}
?>

<h2>Bestellung basierend auf Angebot anlegen</h2>

<form method='POST' action='./controller/purchaseOrderFormHandler.php'>
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

<h2>Bestellung ohne Angebot anlegen</h2>

<form method='POST' action='./controller/purchaseOrderFormHandler.php'>
    <div class="form-group">
        <label for="supplier">Lieferant</label>
        <select id="supplier" name="supplier" class="form-control">
            <?php
            $dbSupplier = new SupplierDAO;

            $supplier = $dbSupplier->getSupplierStock();

            for ($i = 0; $i < count($supplier); $i++) {
                echo "<option value=" . $supplier[$i]->getId() . ">";
                echo $supplier[$i]->getName();
                echo "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="orderDate">Bestellungsdatum</label>
        <input id='orderDate' name="orderDate" type='date'>
    </div>
    <div class="form-group">
        <label for="deliveryType">Lieferungsart</label>
        <select id="deliveryType" name="deliveryType" class="form-control">
            <option value="C">Komplett</option>
            <option value="P">Teil</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Erstellen</button>
</form>
<?php
/*
  <form method='GET'>
  Artikelname <input type='text' name='name'>
  Einkaufspreis <input type='text' name='buyPrice'>
  Verkaufspreis <input type="text" name="sellPrice">
  Basiseinheit <input type="text" name="unit">
  Verpackungseinheit<input type="text" name="packUnit">
  Verpackungsgröße <input type="text" name="packSize">
  Mindestbestand <input type="text" name="minStock">
  Margenaufschlag <input type="text" name="surcharge">
  <?php
  if ($new) {
  echo " <button type='submit' name=\"subNewArticle\">Eintragen</button>";
  } else {
  echo " <button type='submit' name=\"modArticle\">Eintragen</button>";
  }
  ?>
  Lieferant
  <select name="vendor">
  <option>Test</option>
  <?php
  include_once '../../persistance/dao/dao_purchase/SupplierDAO.php';
  include_once '../../persistance/model/Supplier.php';
  $db = new SupplierDAO;

  $vendors = $db->getSupplierStock();

  for ($i = 0; $i < count($vendors); $i++) {
  echo "<option name=" . $vendors[$i]->getId() . ">";
  echo $vendors[$i]->getName();
  echo "</option>";
  }
  ?>
  </select>
  Artikelgruppe
  <select name="group">
  <option>Test</option>
  <?php
  include_once '../../persistance/dao/dao_purchase/ArticleGroupDAO.php';
  include_once '../../persistance/model/ArticleGroup.php';
  $db = new ArticleGroupDAO;

  $groups = $db->getAllArtikleGroup();

  for ($i = 0; $i < count($groups); $i++) {
  echo "<option name=" . $article[$i]->getId() . ">";
  echo $groups[$i]->getName();
  echo "</option>";
  }
  ?>
  </select>
  </form>

 */?>
