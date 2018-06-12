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
        /*braucht man dafür irgendeine Form von Submit?*/
    
        include_once '../../persistance/dao/dao_purchase/OfferOrderDAO.php';
        include_once '../../persistance/model/OfferOrders.php';
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
        <option>Lieferant</option>
        <?php
            /*Datenbankzugriff
             * Exisitierende Lieferantennamen zur Auswahl anzeigen*/
             /*ausgewählter Lieferant muss übergeben werden, da nur jene Artikel
              *weiter unten ausgewählt werden können, die dem gewählten Lieferanten
              *zuzurechnen sind. jquery: onchange submit
              */
        
            include_once '../../persistance/dao/dao_purchase/SupplierDAO.php';
            include_once '../../persistance/model/Supplier.php';
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

    Anzahl unterschiedlicher Artikel <input type='number' name='numberofarticles'>
    </br>
        
    <?php
     /*mit javascript arbeiten? muss direkt das formular daran angepasst werden,
       um wie viele unterschiedliche artikel es sich handelt*/
    ?>
    
     Artikel auswählen 
    <select name="articlename">
         
        <option>Artikel</option>
        <?php
        /*brauche Funktion: getArticlesVendor (alle Artikel eines Lieferanten) 
         *oder muss man das auch mit javascript machen? (kann ja nicht jedes mal ein submit machen)
        */?>       
    </select>
    </br>
    
    Stückzahl Artikel <input type='text' name='quantityarticle'>
    </br>
        
    
    <?php
    if (isset($_GET['numberofarticles'])) {
        $numberartoffer = $_GET['numberofarticles'];
        
        for($i=0; $i<=$numberartoffer; $i++) {
            
            echo "Artikel auswählen <select name='articlename'>";
            echo "<option>Artikel</option>";
        
        /*Datenbankzugriff
         * brauche Funktion: getArticlesVendor (alle Artikel eines Lieferanten) 
         * Exisitierende Artikel zu oben gewähltem Lieferanten zur Auswahl anzeigen
            echo "</option>";
        */     
            echo "</select>";
            echo "</br>";
    
            echo "Stückzahl Artikel <input type='text' name='quantityarticle'>";
            echo "</br>";    
            $i++;
        }
          
    }
        
    ?>
    
    
    Gesamtpreis Angebot <input type='text' name='buyPrice'>
    
    /*funktion: gesamtpreis der ausgewählten artikel (unter berücksichtigung der 
    gewählten stückzahl berechnen*/
    
    </br>   
    <input type="submit" name="submit" value="Eintragen"/>
 
   
</form>
