<?php
/* falls alle felder ausgefüllt wurden:
 * neues Offer in DB inserten: setOffer 
 *  */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/includes.php';
?>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<form action="OfferArticleFormHandler.php" method="POST" class="table table-bordered table-hover">

    <?php
    if (isset($_POST['suppliername'])) {
        $supplierName = $_POST['suppliername'];

        /* echo "$supplierName"; */

        $supplierDAO = new SupplierDAO;
        $_SESSION['supplierID'] = $supplierDAO->getSupplierIDByName($supplierName);
        $dbobje = new ArticleDAO;
        $articles = $dbobje->getArticleFromSupplier($_SESSION['supplierID']);
    }
    ?>

    Artikel des gew&auml;hlten Lieferanten ausw&auml;hlen:
    <br/>    
    <label for="artikel1">Artikel 1:</label>
    <select class="form-control" id="artikel1" name='articleasupplier'>
        <?php
        /* foreach ($articles as $article => $articleDesc) {
          echo "<option name=".$articleDesc.">";
          echo $articleDesc;
          echo "</option>";
          } */
        for ($i = 0; $i < count($articles); $i++) {
            echo "<option value=" . $articles[$i]->getID() . ">";
            echo $articles[$i]->getArticleDesc();
            echo "</option>";
        }
        ?>
    </select>
    St&uuml;ckzahl Artikel 1 angeben:
    <input type='number' name='articleaquantity'>
    <br/>

    <label for="artikel2">Artikel 2:</label>
    <select class="form-control" id="artikel2" name='articlebsupplier'>
        <?php
        for ($i = 0; $i < count($articles); $i++) {
            echo "<option value=" . $articles[$i]->getID() . ">";
            echo $articles[$i]->getArticleDesc();
            echo "</option>";
        }
        ?>
    </select>
    Stückzahl Artikel 2 angeben:
    <input type='number' name='articlebquantity'>
    <br/>

    <label for="artikel3">Artikel 3:</label>
    <select class="form-control" id="artikel3" name='articlecsupplier'>
        <?php
        for ($i = 0; $i < count($articles); $i++) {
            echo "<option value=" . $articles[$i]->getID() . ">";
            echo $articles[$i]->getArticleDesc();
            echo "</option>";
        }
        ?>
    </select>
    Stückzahl Artikel 3 angeben:
    <input type='number' name='articlecquantity'>
    <br/>



    <input type="submit" name="artikelauswahl" value="Auswahl best&auml;tigen" class="btn btn-primary"/>
</form>




