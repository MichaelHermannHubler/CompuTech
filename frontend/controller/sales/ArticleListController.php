<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/service/ArticleService.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/controller/sales/articleList/shoppingCartController.php';

?>

<a HREF="./articleList/shoppingCartDisplay.php">Warenkorb</a>

<br>

<div class="search-container">
	<form method="post">
		<input type="text" placeholder="Suche..." name="search">
		<button type="submit"><i class="fa fa-search"></i></button>
	</form>
</div>

<?php



$articleService = new ArticleService();
$filter = null;
if (isset($_POST['search'])){
	$filter = $_POST['search'];

}
$resultCheck = $articleService->getArticles($filter);
if (!empty($resultCheck)) {
    echo "<table><tr><th>ID</th><th>Name</th><th>Preis</th><th>Aktionen</th></tr>";
}
foreach ($resultCheck as $list) {
    echo "<tr><td>" . $list[0]->getArticleNumber() . "</td><td>" . $list[0]->getArticleDesc() . "</td><td>" . $list[0]->getSellingPrice() . "</td>";

    echo '<td><form method="get">';
    echo '<input type="hidden" name="articleIdToAdd"  value="'.$list[0]->getID().'"/>';
    echo '<input type="hidden" name="desc"  value="'.$list[0]->getArticleDesc().'"/>';
    echo '<input type="hidden" name="price"  value="'.$list[0]->getSellingPrice().'"/>';
    echo '<input type="submit" value="Hinzufügen" name="add">';
    echo '</form></td>';

    echo "</tr>";


}
if (!empty($resultCheck)) {
    echo "</table>";
} else {
    echo "Es konnten keine Artikel gefunden werden!";
}


?>
