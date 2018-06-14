<?php
/*falls alle felder ausgefüllt wurden:
 * neues Offer in DB inserten: setOffer 
 *  */


?>

<h2>Angebot eintragen</h2>
</br>
<form action="" method="get" name="createoffer">
    Angebotsnummer <input type='text' name='offernumber'>
    <?php
        /*Datenbankzugriff: Eingegebenen Angebotsnummer mit bereits gespeicherten vergleichen:*/
        /*eventuell doch lieber automatisch genrieren lassen?? brauche funktion!*/
    
        
        $dbobj = new OrderOfferDAO;
        
        $alloffers = $dbobj->getAllOfferOrder();
        
        foreach ($alloffers as $offer => $number) {
           if ($_GET['offernumber'] == $number) {
               echo "Angebotsnummer exisitert bereits, bitte eine neue Nummer eingeben";
           }
       }
    ?>
    </br>

    Lieferant auswählen 
    <select name="suppliername">
        <!--<option>Lieferant</option>-->
        <?php
            /*Datenbankzugriff
             * Exisitierende Lieferantennamen zur Auswahl anzeigen*/
             /*ausgewählter Lieferant muss übergeben werden, da nur jene Artikel
              *weiter unten ausgewählt werden können, die dem gewählten Lieferanten
              *zuzurechnen sind. jquery: onchange submit
              */
            $db = new SupplierDAO;
            $suppliers = $db->getSupplierStock();
            
            for($i = 0; $i < count($suppliers); $i++){
                echo "<option name=" . $suppliers[$i]->getID() . ">";
                echo $suppliers[$i]->getName();
                echo "</option>";
                
            }
             
        ?>       
    </select>
    </br>
    <input type="submit" name="lieferantauswahl" value="Auswahl bestätigen"/>
    
    </br>

    <!--Anzahl unterschiedlicher Artikel <input type='number' name='numberofarticles'>
    </br>-->
        
    <?php
   
    if (isset($_GET['suppliername'])) {
        $supplierID = $_GET['suppliername'];
    }
        
    $dbobje = new ArticleDAO;
    $articles = $dbobje->getArticleFromSupplier($supplierID);
        
    $count = count($supplierID);    
        
     
        echo "Artikel des gewählten Lieferanten: ";
        echo "</br>";
        
    foreach ($articles as $article => $articleDesc) {
        echo ".$articleDesc.";
        echo "</br>";
        echo "Stückzahl Artikel auswählen: ";
        echo "<input type='number' name='stueckzahl'>";
        }

    ?>
    
    
    Gesamtpreis Angebot <input type='text' name='buyPrice'>
    
    <!--funktion: gesamtpreis der ausgewählten artikel (unter berücksichtigung der 
    gewählten stückzahl berechnen-->
    
    </br>   
    <input type="submit" name="submit" value="Eintragen"/>
 
   
</form>
