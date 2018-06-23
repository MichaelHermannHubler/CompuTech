<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 09.06.2018
 * Time: 16:00
 */


include_once $_SERVER['DOCUMENT_ROOT'] . '/computech/frontend/controller/sales/articleList/shoppingCartController.php';

$checkOut = true;
//SHOULD BE DONE FOR ALL
if (isset($_POST['nameV'])) {
//    function __construct($id, $street, $city, $postCode, $country) {
    $rechnungsAdresse = new Address(null, $_POST['straseR'], $_POST['stadtR'], $_POST['plzR'], $_POST['landR'], $_POST['nameR']);
    $versandAdresse = new Address(null, $_POST['straseV'], $_POST['stadtV'], $_POST['plzV'], $_POST['landV'], $_POST['nameV']);
    $_SESSION['versand'] = $versandAdresse;
    $_SESSION['rechnung'] = $rechnungsAdresse;

}





?>

<?php include_once$_SERVER['DOCUMENT_ROOT'] . '/computech/frontend/controller/sales/articleList/shoppingCartDisplay.php'; ?>
</br>

<div class="container">
<h2>Versanddetails</h2>
<p><?php echo $_SESSION['versand']->getCity(); ?></p>
<p><?php echo $_SESSION['versand'] ->getCountryCode(); ?></p>
<p><?php echo $_SESSION['versand'] ->getPostalCode(); ?></p>
<p><?php echo $_SESSION['versand'] ->getStreet(); ?></p>

</br>
<h2>Rechnungsdetails</h2>

<p><?php echo $_SESSION['rechnung'] ->getCity(); ?></p>
<p><?php echo $_SESSION['rechnung'] ->getCountryCode(); ?></p>
<p><?php echo $_SESSION['rechnung'] ->getPostalCode(); ?></p>
<p><?php echo $_SESSION['rechnung'] ->getStreet(); ?></p>

<a type="button" class="btn btn-outline-secondary my-2 my-sm-0" href="OrderSatusController.php?bestellen=true">Kostenpflichtig bestellen</a>
</div>