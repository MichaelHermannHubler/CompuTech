<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/frontend/includes.php';
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

<a href="http://localhost/Computech/frontend/?menu=offer"><button class="btn btn-primary">Zur&uuml;ck</button></a>
<form action="offerDetailHandler.php" method="POST">
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
            $cnt = 0;
            foreach ($articles as $article) {
                $price = $article->getPrice();
                $quant = $article->getQuantity();

                //$_SESSION[$cnt] = $article->getArticleNumber();
                $num = $article->getArticleNumber();
                echo"<tr>";
                //echo"<td>" . $_SESSION['num'] . "</td>";
                echo"<td><input type=\"hidden\" name= \"num$cnt\" value=\"$num\">$num</td>";
                echo"<td><input type=\"text\" value=\"$price\" name=\"price$cnt\" required></td>";
                echo"<td><input type=\"text\" value=\"$quant\" name=\"quantity$cnt\" required></td>";
                echo "</tr>";
                $cnt++;
            }
            ?>
        </tbody>
    </table>
    <?php
    if($cnt > 0){
        echo"<input type=\"submit\" name=\"speichern\" value=\"Speichern\" class=\"btn btn-primary\"/>";
    }
    ?>
    
</form>