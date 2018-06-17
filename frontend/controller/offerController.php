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
       
