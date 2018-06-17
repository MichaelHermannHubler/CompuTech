<?php
/*falls alle felder ausgefüllt wurden:
 * neues Offer in DB inserten: setOffer 
 *  */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/frontend/includes.php';


?>



<form action="OfferArticleFormHandler.php" method="get">
        
    <?php
   
    if (isset($_GET['suppliername'])) {
        $supplierName = $_GET['suppliername'];
        
        /*echo "$supplierName";*/
        
        $supplierDAO = new SupplierDAO; 
        $_SESSION['supplierID'] = $supplierDAO->getSupplierIDByName($supplierName);
        $dbobje = new ArticleDAO;
        $articles = $dbobje->getArticleFromSupplier($_SESSION['supplierID']);
    }
        ?>
         
        Artikel des gewählten Lieferanten auswählen:
        <br/>
        Artikel 1:
        <select name='articleasupplier'>
        <?php
                /*foreach ($articles as $article => $articleDesc) {
                    echo "<option name=".$articleDesc.">";
                    echo $articleDesc;
                    echo "</option>";   
                }*/
            for($i = 0; $i< count($articles); $i++) {
                echo "<option value=" . $articles[$i]->getID() . ">";
                echo $articles[$i]->getArticleDesc();
                echo "</option>";
            }
            ?>
        </select>
        Stückzahl Artikel 1 angeben:
        <input type='number' name='articleaquantity'>
       <br/>
        
        Artikel 2:
        <select name='articlebsupplier'>
        <?php
            for($i = 0; $i< count($articles); $i++) {
                echo "<option value=" . $articles[$i]->getID() . ">";
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
                echo "<option value=" . $articles[$i]->getID() . ">";
                echo $articles[$i]->getArticleDesc();
                echo "</option>";
            }?>
        </select>
        Stückzahl Artikel 3 angeben:
        <input type='number' name='articlecquantity'>
        <br/>
       
    
   
        <input type="submit" name="artikelauswahl" value="Auswahl bestätigen"/>
</form>
    
    
    
  
