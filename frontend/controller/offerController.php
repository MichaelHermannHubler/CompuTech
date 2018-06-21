<?php
/* falls alle felder ausgef�llt wurden:
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
<div class="container">
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand">Computech GmbH</a>
    </nav>
</div>
<div class="container">

    </br>

    <h2>Angebot eintragen</h2>
    </br>
    <form action="addArticlesOffer.php" method="POST" name="lieferantwaehlen">


        <label for="suppliername">Lieferant ausw&auml;hlen</label>
        <select class="form-control" id="suppliername" name="suppliername">
            <?php
            $db = new SupplierDAO;
            $suppliers = $db->getSupplierStock();

            for ($i = 0; $i < count($suppliers); $i++) {
                echo "<option name=" . $suppliers[$i]->getName() . ">";
                echo $suppliers[$i]->getName();
                echo "</option>";
            }
            ?>       
        </select>

        </br>
        <input type="submit" class="btn btn-outline-secondary my-2 my-sm-0" name="lieferantauswahl" value="Auswahl best&auml;tigen"/>
    </form>

