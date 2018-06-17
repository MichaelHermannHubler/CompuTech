<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/includes.php';
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

<button><a href="http://localhost/Computech/frontend/?menu=offer">Zurück</a></button>
<table  class="table table-bordered">
    <thead>
        <tr>
            <th>Artikel</th>
            <th>Preis</th>
            <th>Menge</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $OfferArticle = new OfferArticleDAO;

        $id = $_GET['Num'] - 1000;

        $articles = $OfferArticle->getOfferArticle($id);

        foreach ($articles as $article) {
            $price = $article->getPrice();
            $quant = $article->getQuantity();
            echo"<tr>";
            echo"<td>". $article->getArticleNumber() . "</td>";
            echo"<td><input type=\"text\" value=\"$price\"></td>";
            echo"<td><input type=\"text\" value=\"$quant\"></td>";     
            echo "</tr>";
        }
        ?>
    </tbody>
</table>