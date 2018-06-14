<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 10.06.2018
 * Time: 21:59
 */

include_once'../../persistance/dao/AbstractDAO.php';
include_once '../../persistance/dao/dao_purchase/ArticleGroupDAO.php';
include_once '../../persistance/dao/dao_purchase/ArticleDAO.php';
include_once "../../persistance/dao/dao_warehouse/PicklistDAO.php";
include_once "../../persistance/dao/dao_warehouse/WarehouseLocationDAO.php";
include_once '../../persistance/model/Article.php';
include_once'../../persistance/model/ArticleGroup.php';
include_once "../../persistance/model/Picklist.php";
include_once "../../persistance/model/WarehouseLocation.php";

$picklistdb = new PicklistDAO();
$cont = true;
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
      integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<div class="container">
    <form method="get">

        <?php
        if(isset($_GET["save_all"])){
            $picklistID = $_GET["picklisthidden"];
            $picklist = $picklistdb->getPicklist($picklistID);

            $articles = $picklistdb->getPicklistArticles($picklistID);
            foreach ($articles as $value) {
                if(!$value[2]){
                    $article = $value[0];
                    $quantity = $value[1];

                    $picklistdb->setPosCompleted($picklistID, $article->getID(), $quantity);
                }
            }

            $picklistdb->setCompleted($picklistID);
            $cont = false;

            ?>
            <div class="alert alert-success" role="alert">
                Pickliste <?php echo $picklist->getNumber(); ?>  wurde erfolgreich abgeschlossen.
            </div>
            <?php
        }else if (isset($_GET["save"])){
            $picklistID = $_GET["picklisthidden"];
            $picklist = $picklistdb->getPicklist($picklistID);
            $arr = $_GET["chb"];

            foreach ($arr as $value) {
                if (!explode(";", $value)[3]) {
                    $articleID = explode(";", $value)[1];
                    $quantity = explode(";", $value)[2];

                    $picklistdb->setPosCompleted($picklistID, $articleID, $quantity);
                }
            }

            ?>
            <div class="alert alert-success" role="alert">
                Pickliste <?php echo $picklist->getNumber(); ?>  wurde erfolgreich gespeichert.
            </div>
            <?php
        }

        $picklists = $picklistdb->getPicklists();

        ?>

        <div class="input-group">
            <div class="input-group-prepend">
                <label class="input-group-text" for="picklist">Pickliste:</label>
            </div>
            <select class="custom-select" id="picklist" name="picklist">
                <option value="-1">Pickliste auswählen</option>
                <?php
                    foreach ($picklists as $picklist) {
                        if (!$picklist->getCompleted()) {
                        ?>
                        <option
                            value="<?php echo $picklist->getId(); ?>"
                            <?php if (isset($_GET["picklist"]) && $_GET["picklist"] == $picklist->getId()) {
                                echo "selected";
                            } ?>
                        >
                            <?php echo $picklist->getNumber(); ?>
                        </option>
                        <?php
                        }
                    }
                ?>
            </select>
            <div class="input-group-append">
                <input type="submit" class="btn btn-outline-secondary" value="Auswählen">
            </div>
        </div>

        <?php
        if($cont && isset($_GET["picklist"])){
            $picklist = $picklistdb->getPicklist($_GET["picklist"]);
            $articles = $picklistdb->getPicklistArticles($picklist->getId());
            ?>
            <input type="hidden" value="<?php echo $picklist->getId(); ?>" name="picklisthidden">
            <table class="table" id="returnTable">
                <thead>
                    <tr>
                        <th>Artikelnummer</th>
                        <th>Anzahl</th>
                        <th>Erledigt</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($articles as $value){
                    $article = $value[0];
                    $quantity = $value[1];
                    $completed = $value[2];
                    ?>
                    <tr>
                        <td><?php echo $article->getArticleNumber(); ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td>
                            <input
                                type="checkbox"
                                <?php if($completed) echo "checked"; ?>
                                name="chb[]"
                                value="<?php echo $picklist->getId() . ";" . $article->getID() . ";" . $quantity . ";" . $completed ?>"
                            >
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <input type="submit" class="btn btn-outline-primary" value="Pickliste speichern" name="save">
            <input type="submit" class="btn btn-outline-primary" value="Pickliste abschließen" name="save_all">
            <?php
        }
        ?>
    </form>
</div>

