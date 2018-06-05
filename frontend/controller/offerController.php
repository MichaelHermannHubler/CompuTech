<?php
if(isset($_GET['offernumber']) && isset($_GET['suppliername']) && isset($_GET['articlename']) && isset($_GET['quantityarticle']) & isset($_GET['buyPrice'])){
	
	if($_GET['offernumber'] != "" && $_GET['suppliername'] != "" && $_GET['articlename'] != "" && $_GET['quantityarticle'] != "" && $_GET['buyprice'] != "" ){
		
		/*if($_GET['offernumber'] == ){ //??? überprüfen, ob die eingegebene offernumber bereits existiert // vs. exisiterender Offernumbers
			
			wenn offernumber noch nicht exisitiert - in DB eintragen
			
		}else{
			echo = "Angebotsnummer exisitiert bereits, bitte neue Nummer eingeben!";
		}*/
            	
	}else{
            echo "Bitte alle Pflichtfelder ausfüllen!";
        }
}
?>
<h2>Angebot eintragen</h2>
</br>
<form action="" method="get" name="offercontroller" id="createoffer">
    Angebotsnummer <input type='text' name='offernumber'>
    </br>
    
    Lieferant auswählen 
    <select name="suppliername">
        <option>Lieferant</option>
        <?php
            /*Datenbankzugriff
             * Exisitierende Lieferantennamen zur Auswahl anzeigen
             * 
            include_once '../../persistance/dao/dao_purchase/SupplierDAO.php';
            include_once '../../persistance/model/Supplier.php';
            $db = new SupplierDAO;
            $suppliers = $db->getSupplier();
            for ($i = 0; $i < count($suppliers); $i++) {
                echo "<option name=" . $suppliers[$i]->name . ">";
                echo "</option>";
            }
             */
        ?>
    </select>
    </br>
    
    Artikel auswählen 
    <select name="articlename">
         
        <option>Artikel</option>
        <?php
        /*Datenbankzugriff
         * Exisitierende Artikel zu oben gewähltem Lieferanten zur Auswahl anzeigen
            echo "</option>";
        */?>       
    </select>
    </br>
    
    Stückzahl Artikel <input type='text' name='quantityarticle'>
    </br>
    Gesamtpreis Angebot <input type='text' name='buyPrice'>
    </br>   
    <input type="submit" name="submit" value="Eintragen"/>
 
   
</form>
