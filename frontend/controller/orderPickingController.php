<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 10.06.2018
 * Time: 08:49
 */

include_once '../persistance/model/ArticleGroup.php';
include_once '../persistance/dao/AbstractDAO.php';
include_once '../persistance/dao/dao_purchase/ArticleGroupDAO.php';
include_once '../persistance/dao/dao_purchase/ArticleDAO.php';
include_once '../persistance/dao/dao_warehouse/PicklistDAO.php';
include_once '../persistance/model/Article.php';
include_once '../persistance/model/Picklist.php';
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
      integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script type="text/javascript">
    function mydeleteRow(pos) {
        var s = document.getElementById("pickedTable");
        s.deleteRow(pos);
    }
</script>

<form method="get">
    <input type="hidden" name="page" value="picking">
    <div class="container">

    <?php
    $db = new ArticleDAO();

    $articles = $db->getStockList();

    $released = false;
    if(isset($_GET["release"])){
        $picklistDB = new PicklistDAO();
        $picklist = new Picklist(null, $picklistDB->getNextNumber(), false);

        if (isset($_GET["pos"]) && is_array($_GET["pos"])) {
            foreach ($_GET["pos"] as $pos) {

                $number = explode(";", $pos)[0];
                $amount = explode(";", $pos)[1];

                $article = $db->getArticle($number-1000);

                $picklist->addArticle($article->getID(), $amount);
            }
        }else if(isset($_GET["pos"])){
            $number = explode(";", $pos)[0];
            $amount = explode(";", $pos)[1];

            $article = $db->getArticle($number);
            $picklist->addArticle($article->getID(), $amount);
        }

        $picklistDB->save($picklist);
        $released = true;
        ?>
    <div class="alert alert-success" role="alert">
        Pickliste <?php echo $picklist->getNumber(); ?>  wurde erfolgreich generiert.
    </div>
    <?php
}

?>

        <div class="row">
            <div class="col-8">
                <div class="input-group col-10">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="article">Artikel:</label>
                    </div>
                    <select class="custom-select" id="article" name="article" required>
                        <option value="-1">Artikel auswählen</option>
                        <?php
                        foreach ($articles as $article) {
                            ?>
                            <option
                                value="<?php echo $article->getArticleNumber(); ?>"><?php echo $article->getArticleNumber(); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <input type="number" id="amount" name="amount" min="1">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-outline-secondary" value="Hinzufügen">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <?php
                if (!$released && (isset($_GET["pos"]) || (isset($_GET["article"]) && $_GET["article"] != -1))) {
                    ?>
                    <table class="table" id="pickedTable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Artikel</th>
                            <th scope="col">Menge</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        if (isset($_GET["pos"]) && is_array($_GET["pos"])) {
                            foreach ($_GET["pos"] as $pos) {

                                $number = explode(";", $pos)[0];
                                $amount = explode(";", $pos)[1];
                                ?>
                                <tr>
                                    <input type="hidden" value="<?php echo $pos; ?>" name="pos[]">
                                    <th><?php echo $i + 1; ?></th>
                                    <td><?php echo $number; ?></td>
                                    <td><?php echo $amount; ?></td>
                                    <td>
                                        <button onclick="mydeleteRow(<?php echo $i + 1; ?>);"><span
                                                class="glyphicons glyphicons-minus"></span>-
                                        </button>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        if (isset($_GET["article"]) && $_GET["article"] != -1) {
                            ?>
                            <tr>
                                <input type="hidden" value="<?php echo $_GET["article"] . ";" . $_GET["amount"]; ?>"
                                       name="pos[]">
                                <th><?php echo $i + 1; ?></th>
                                <td><?php echo $_GET["article"]; ?></td>
                                <td><?php echo $_GET["amount"]; ?></td>
                                <td>
                                    <button onclick="mydeleteRow(<?php echo $i + 1; ?>);"><span
                                            class="glyphicons glyphicons-minus"></span>-
                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <input type="submit" class="btn btn-outline-primary" value="Pickliste freigeben" name="release">
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</form>