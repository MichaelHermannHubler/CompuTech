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
        
         
        echo "Artikel des gewählten Lieferanten auswählen: ";
        echo "</br>";
        echo "Artikel 1: ";
        echo "<select name='articleasupplier'>";
        
            for($i = 0; $i<= count($articles); $i++) {
                echo "<option name=" . $articles[$i]->getBuyingprice() . ">";
                echo $articles[$i]->getArticleDesc();
                echo "</option>";
            }
        echo "</select>";
        echo "Stückzahl Artikel 1 angeben: ";
        echo "<input type='number' name='articleaquantity'>";
        echo "</br>";
        
        echo "Artikel 2: ";
        echo "<select name='articlebsupplier'>";
        
            for($i = 0; $i<= count($articles); $i++) {
                echo "<option name=" . $articles[$i]->getBuyingPrice() . ">";
                echo $articles[$i]->getArticleDesc();
                echo "</option>";
            }
        echo "</select>";
        echo "Stückzahl Artikel 2 angeben: ";
        echo "<input type='number' name='articlebquantity'>";
        echo "</br>";
        
        echo "Artikel 3: ";
        echo "<select name='articlecsupplier'>";
        
            for($i = 0; $i<= count($articles); $i++) {
                echo "<option name=" . $articles[$i]->getBuyingPrice() . ">";
                echo $articles[$i]->getArticleDesc();
                echo "</option>";
            }
        echo "</select>";
        echo "Stückzahl Artikel 3 angeben: ";
        echo "<input type='number' name='articlecquantity'>";
        echo "</br>";
       
    
    ?>
        <input type="submit" name="artikelauswahl" value="Auswahl bestätigen"/>
</form>
    
    
    
  
