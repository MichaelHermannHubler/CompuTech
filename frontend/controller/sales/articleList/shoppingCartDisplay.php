<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
	      integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<div class="container">
	<nav class="navbar navbar-light bg-light justify-content-between">
		<a class="navbar-brand">Computech GmbH</a>
	</nav>
</div>
<div class="container">
	<nav class="navbar navbar-light bg-light justify-content-between">
		<a class="navbar-brand">Webshop</a>
		<a class="btn btn-outline-secondary my-2 my-sm-0"
		   href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/computech/frontend/index.php">Home</a>
		<a class="btn btn-outline-secondary my-2 my-sm-0"
		   href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/computech/frontend/controller/sales/articleList/shoppingCartDisplay.php">Zum
			Warenkorb</a>
		<a class="btn btn-outline-secondary my-2 my-sm-0"
		   href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/computech/frontend/logout.php">Logout</a>
	</nav>
</div>

</br>

<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 04.06.2018
 * Time: 16:07
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/computech/frontend/controller/sales/articleList/shoppingCartController.php';


echo "<div class=\"container\">";
if (isset($_SESSION['articleList'])) {

    echo "<table>";
    $firstRow = true;
    $sum = 0;
    foreach ($_SESSION['articleList'] as $item) {

        if ($firstRow) {

            echo "<table class=\"table table-bordered table-hover\"><tr><th>Name</th><th>Anzahl</th><th>Einkaufspreis</th>";
            if (isset($checkOut) && $checkOut) {
                //Dont display buttons

            } else {
                echo "<th>Aktionen</th>";
            }
            echo "</tr>";
            $firstRow = false;
        }

        if ($item->getAmount() > 0) {
            echo '<tr>';

            echo '<td>';
            $id = $item->getArticleId();
            echo $item->getArticleDesc();
            echo '</td>';

            echo '<td>';
            echo $item->getAmount();
            echo '</td>';
            echo '<td>';
            echo $item->getPrice();
            echo '</td>';

            $sum = $sum + ($item->getAmount() * $item->getPrice());
            if (isset($checkOut) && $checkOut) {
                //Dont display buttons

            } else {
                echo '<td>';
                echo '<form method="get">';
                echo '<input type="hidden" name="articleIdToDelete"  value="' . $id . '"/>';
                echo '<input class="\btn btn-outline-secondary my-2 my-sm-0\" type="submit" value="-" >';
                echo '</form>';

                echo '<form method="get">';
                echo '<input type="hidden" name="articleIdToAdd"  value="' . $id . '"/>';
                echo '<input type="hidden" name="desc"  value="' . $item->getArticleDesc() . '"/>';
                echo '<input type="hidden" name="price"  value="' . $item->getPrice() . '"/>';
                echo '<input class="\btn btn-outline-secondary my-2 my-sm-0\" type="submit" value="+" name="add">';
                echo '</form>';

                echo '</td>';

            }

            echo '</tr>';


        }


    }


    echo "</table>";

    echo "<h3>Summe: � " . $sum . "</h3>";


    if (isset($_SESSION['versand']) && isset($_SESSION['rechnung'])) {

        if (isset($checkOut) && $checkOut) {

        } else {
            echo "<a class='\btn btn-outline-secondary my-2 my-sm-0' type = 'button' href='../CheckoutController.php'>Zur Kasse gehen</a>";

        }
    } else {
        echo "<a type = 'button' class=\"btn btn-outline-secondary my-2 my-sm-0\" href='../checkoutAdressController.php'>Zur Kasse gehen</a>";

    }
} else {
    echo "Keine Artikel im Warenkorb";
}


echo "</div>";

?>