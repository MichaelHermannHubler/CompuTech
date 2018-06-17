<?php
/*falls alle felder ausgefüllt wurden:
 * neues Offer in DB inserten: setOffer 
 *  */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/frontend/includes.php';


?>



<form action="" method="get" name="artikelwaehlen">
        
    <?php
   
    if (isset($_GET['suppliername'])) {
        $supplierDAO = new SupplierDAO; 
        $supplierID = $supplierDAO->getSupplierIDByName($_GET['suppliername']);
        $dbobje = new ArticleDAO;
        $articles = $dbobje->getArticleFromSupplier($supplierID);
    }
        ?>
         
        Artikel des gewählten Lieferanten auswählen:
        <br/>
        Artikel 1:
        <select name='articleasupplier'>
        <?php
            for($i = 0; $i< count($articles); $i++) {
                echo "<option name=" . $articles[$i]->getBuyingprice() . ">";
                echo $articles[$i]->getArticleDesc();
                echo "</option>";
            }?>
        </select>
        Stückzahl Artikel 1 angeben:
        <input type='number' name='articleaquantity'>
       <br/>
        
        Artikel 2:
        <select name='articlebsupplier'>
        <?php
            for($i = 0; $i< count($articles); $i++) {
                echo "<option name=" . $articles[$i]->getBuyingPrice() . ">";
                echo $articles[$i]->getArticleDesc();
                echo "</option>";
            }?>
        </select>
        Stückzahl Artikel 2 angeben:
        <input type='number' name='articlebquantity'>
        <br/>
        
        Artikel 3:
        <select name='articlecsupplier'>
        <?php
            for($i = 0; $i< count($articles); $i++) {
                echo "<option name=" . $articles[$i]->getBuyingPrice() . ">";
                echo $articles[$i]->getArticleDesc();
                echo "</option>";
            }?>
        </select>
        Stückzahl Artikel 3 angeben:
        <input type='number' name='articlecquantity'>
        <br/>
       
    
   
        <input type="submit" name="artikelauswahl" value="Auswahl bestätigen"/>
</form>
    
    
    
  
