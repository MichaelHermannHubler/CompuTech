<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 09.06.2018
 * Time: 16:00
 */


include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/controller/sales/articleList/shoppingCartController.php';

$checkOut = true;
//SHOULD BE DONE FOR ALL
if (isset($_POST['nameV'])) {
//    function __construct($id, $street, $city, $postCode, $country) {
    $rechnungsAdresse = new Address(null, $_POST['straseR'], $_POST['stadtR'], $_POST['plzR'], $_POST['landR']);
    $versandAdresse = new Address(null, $_POST['straseV'], $_POST['stadtV'], $_POST['plzV'], $_POST['landV']);
    $_SESSION['versand'] = $versandAdresse;
    $_SESSION['rechnung'] = $rechnungsAdresse;



    var_dump($_SESSION['versand']);
    var_dump($_SESSION['rechnung']);
}


if (isset($_GET['bestellen']) && $_GET['bestellen']) {

	$articleService = new ArticleService();
    $result = $articleService->processOrder($_SESSION['articleList'], $_SESSION['versand'],$_SESSION['rechnung']);
	if (is_bool($result)){
		echo "Bestellung wurde erstellt";
	}
	else{
		echo "Es ist".$result." Artikel nicht mehr verfügbar";
	}


}


?>

<h>Bestellunsgübersicht</h>

<?php include_once$_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/controller/sales/articleList/shoppingCartDisplay.php'; ?>

<h2>Versanddetails</h2>
<p><?php echo $_SESSION['versand']->getCity(); ?></p>
<p><?php echo $_SESSION['versand'] ->getCountryCode(); ?></p>
<p><?php echo $_SESSION['versand'] ->getPostalCode(); ?></p>
<p><?php echo $_SESSION['versand'] ->getStreet(); ?></p>

<h2>Rechnungsdetails</h2>

<p><?php echo $_SESSION['rechnung'] ->getCity(); ?></p>
<p><?php echo $_SESSION['rechnung'] ->getCountryCode(); ?></p>
<p><?php echo $_SESSION['rechnung'] ->getPostalCode(); ?></p>
<p><?php echo $_SESSION['rechnung'] ->getStreet(); ?></p>

<a href="CheckoutController.php?bestellen=true">Kostenpflichtig bestellen</a>