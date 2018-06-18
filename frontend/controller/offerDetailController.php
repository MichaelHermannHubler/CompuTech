<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/includes.php';
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

<a href="http://localhost/Computech/frontend/?menu=offer"><button>Zurück</button></a>
<form action="offerDetailHandler.php">
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

            $_SESSION['id'] = $_GET['Num'] - 1000;

            $articles = $OfferArticle->getOfferArticle($_SESSION['id']);

            foreach ($articles as $article) {
                $price = $article->getPrice();
                $quant = $article->getQuantity();
                $_SESSION['num'] = $article->getArticleNumber();
                echo"<tr>";
                echo"<td>" . $_SESSION['num'] . "</td>";
                echo"<td><input type=\"text\" value=\"$price\" name=\"price\"></td>";
                echo"<td><input type=\"text\" value=\"$quant\" name=\"quantity\"></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <input type="submit" name="speichern" value="Speichern"/>
</form>