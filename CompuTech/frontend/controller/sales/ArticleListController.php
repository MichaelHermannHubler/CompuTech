<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/service/ArticleService.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/controller/sales/articleList/shoppingCartController.php';

?>
<body>
<div class="container">
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand">Webshop</a>
        <a class="btn btn-outline-secondary my-2 my-sm-0" href="./controller/sales/articleList/shoppingCartDisplay.php">Zum Warenkorb</a>
        <a class="btn btn-outline-secondary my-2 my-sm-0" href="./logout.php\">Logout</a>
    </nav>
</div>

<br>

<div class="search-container">
	<form method="post">
		<input type="text" placeholder="Suche..." name="search">
		<button type="submit" class="fa fa-search">Ok</button>
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
    echo "<table  class=\"table table-bordered table-hover\" ><tr>
<th>ID</th>
<th>Name</th>
<th>Preis</th>
<th>Aktionen</th>
</tr>";
}
foreach ($resultCheck as $list) {
    echo "<tr><td>" . $list[0]->getArticleNumber() . "</td><td>" . $list[0]->getArticleDesc() . "</td><td>" . $list[0]->getSellingPrice() . "</td>";

    echo '<td><form method="get">';
    echo '<input type="hidden" name="articleIdToAdd"  value="'.$list[0]->getArticleNumber().'"/>';
    echo '<input type="hidden" name="desc"  value="'.$list[0]->getArticleDesc().'"/>';
    echo '<input type="hidden" name="price"  value="'.$list[0]->getSellingPrice().'"/>';
    echo '<input type="submit" class="\btn btn-outline-secondary my-2 my-sm-0\" name="add" value="Hinzufügen"/>';
    echo '</form></td>';

    echo "</tr>";


}
if (!empty($resultCheck)) {
    echo "</table>";
} else {
    echo "Es konnten keine Artikel gefunden werden!";
}


?>
