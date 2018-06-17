<?php
/*falls alle felder ausgefüllt wurden:
 * neues Offer in DB inserten: setOffer 
 *  */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/frontend/includes.php';

?>

<h2>Angebot eintragen</h2>
</br>
<form action="addArticlesOffer.php" method="get" name="lieferantwaehlen">
  
    Lieferant auswählen 
    <select name="suppliername">
             <?php

            $db = new SupplierDAO;
            $suppliers = $db->getSupplierStock();
            
            for($i = 0; $i < count($suppliers); $i++){
                echo "<option name=" . $suppliers[$i]->getName() . ">";
                echo $suppliers[$i]->getName();
                echo "</option>";     
            }      
        ?>       
    </select>
    
    </br>
    <input type="submit" name="lieferantauswahl" value="Auswahl bestätigen"/>
</form>
    
    </br>
    
    

  
    
<form action="" method="get" name="totalberechnen">
    <?php
    
    if(isset($_GET['artikelauswahl']) && ((isset($_GET['articleasupplier']) && isset($_GET ['articleaquantity'])) ||  
                                          (isset($_GET['articlebsupplier']) && isset($_GET ['articlebquantity'])) ||
                                          (isset($_GET['articlecsupplier']) && isset($_GET ['articlecquantity']))) ) {
        
        echo "Berechneter Gesamtpreis Angebot: ";
        
        if(isset ($_GET['articleasupplier'])) {
            $articleaPrice = ($_GET['articleasupplier']);
            $articleaQuant = ($_GET ['articleaquantity']);
            
            $priceA = $articleaPrice*$articleaQuant;
            
        }
         if(isset ($_GET['articlebsupplier'])) {
            $articlebPrice = ($_GET['articlebsupplier']);
            $articlebQuant = ($_GET ['articlebquantity']);
            
            $priceB = $articlebPrice*$articlebQuant;
            
        }
         if(isset ($_GET['articlecsupplier'])) {
            $articlecPrice = ($_GET['articlecsupplier']);
            $articlecQuant = ($_GET ['articlecquantity']);
            
            $priceC = $articlecPrice*$articlecQuant;
            
        }
        
        $offerPrice = $priceA+$priceB+$priceC;
        
        echo ".$offerPrice. Euro";
               
    }
    
    ?>
    
    </br>   
    <input type="submit" name="submit" value="Angebot eintragen"/>
    </br>;

</form>
    
    <?php
    if(isset($_GET['submit'])) {
        
        $create = date("d.m.y");
        /*muss das date ein bestimmtes format haben?*/
        
        
        $dbobjekt = new OfferOrderDAO();
        $offerID = $dbobjekt->getAvailableOffer($supplierID);
        $offernumber = 10000 + $offerID;
        
        
        $dbobjek = new OfferOrders();
        $offer = $dbobjek->setOffer($offernumber, $supplierID, $create, $offerPrice); 
        
        echo "Das Angebot wurde mit Angebotsnummer .$offernumber. gespeichert.";
        
    }
    
    ?>
 
   
