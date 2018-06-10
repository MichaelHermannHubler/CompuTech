<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 10.06.2018
 * Time: 16:03
 */

include_once'../../persistance/dao/AbstractDAO.php';
include_once '../../persistance/dao/dao_purchase/ArticleGroupDAO.php';
include_once '../../persistance/dao/dao_purchase/ArticleDAO.php';
include_once '../../persistance/dao/dao_warehouse/WarehouseLocationDAO.php';
include_once '../../persistance/model/Article.php';
include_once'../../persistance/model/ArticleGroup.php';
include_once '../../persistance/model/WarehouseLocation.php';


$articledb = new ArticleDAO();
$articles = $articledb->getStockList();

$warehousedb = new WarehouseLocationDAO();
$warehouses = $warehousedb->getWarehouseLocations();
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
      integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<script type="text/javascript">
    function switchSelectValue(){
        var selectType = document.getElementById("filtertype").value;
        var selectElement = document.getElementById("filter");
        var replacingElement = null;

        if(selectType == 1){
            replacingElement = document.getElementById("filtertypearticle_preset");
        }else{
            replacingElement = document.getElementById("filtertypewarehouse_preset");
        }

        selectElement.innerHTML = replacingElement.innerHTML;
        selectElement.value = "-1";
    }
</script>

<select class="custom-select" id="filtertypearticle_preset" style="visibility: hidden">
    <option value="-1">Filter auswählen</option>
    <?php
    foreach ($articles as $article) {
        ?>
        <option value="<?php echo $article->getId(); ?>"><?php echo $article->getArticleNumber(); ?></option>
        <?php
    }
    ?>
</select>
<select class="custom-select" id="filtertypewarehouse_preset" style="visibility: hidden">
    <option value="-1">Filter auswählen</option>
    <?php
    foreach ($warehouses as $warehouse) {
        ?>
        <option value="<?php echo $warehouse->getId(); ?>"><?php echo $warehouse->getRack() . "-" . $warehouse->getPosition(); ?></option>
        <?php
    }
    ?>
</select>

<form method="get">
    <div class="container">
        <div class="input-group">
            <div class="input-group-prepend">
                <label class="input-group-text" for="filtertype">Filter:</label>
            </div>
            <select class="custom-select" id="filtertype" name="filtertype" onchange="switchSelectValue();">
                <option value="1" <?php if(!isset($_GET["filtertype"]) || $_GET["filtertype"] == 1){echo "selected"; } ?>>Artikel</option>
                <option value="2" <?php if($_GET["filtertype"] == 2){echo "selected"; } ?>>Lagerplatz</option>
            </select>
            <select class="custom-select" id="filter" name="filter">
                <option value="-1">Filter auswählen</option>
                <?php
                if(!isset($_GET["filtertype"]) || $_GET["filtertype"] == 1) {
                    foreach ($articles as $article) {
                        ?>
                        <option
                            value="<?php echo $article->getId(); ?>"
                            <?php if($_GET["filter"] == $article->getId()) { echo "selected"; }?>
                        >
                            <?php echo $article->getArticleNumber(); ?>
                        </option>
                        <?php
                    }
                }else{
                    foreach ($warehouses as $warehouse) {
                        ?>
                        <option
                            value="<?php echo $warehouse->getId(); ?>"
                            <?php if($_GET["filter"] == $warehouse->getId()) { echo "selected"; }?>
                        >
                            <?php echo $warehouse->getRack() . "-" . $warehouse->getPosition(); ?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>
            <div class="input-group-append">
                <input type="submit" class="btn btn-outline-secondary" value="Filtern">
            </div>
        </div>
        <?php
        if(isset($_GET["filtertype"]) && $_GET["filter"] != -1) {
            ?>
            <table class="table" id="returnTable">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Lagerplatz</th>
                    <th scope="col">Artikel</th>
                    <th scope="col">Beschreibung</th>
                    <th scope="col">Menge</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;

                if($_GET["filtertype"] == 1){
                    $article = $articledb->getArticle($_GET["filter"]);
                    $array = $articledb->getWarehouseLocationArticles($_GET["filter"]);

                    foreach ($array as $value){
                        ?>
                        <tr
                            <?php
                            if($value[1] <= $article->getMinimumLevel()){
                                ?>
                                class="table-danger"
                                <?php
                            }else if($value[1] <= $article->getMinimumLevel()*1.2){
                                ?>
                                class="table-warning"
                                <?php
                            }else{
                                ?>
                                class="table-success"
                                <?php
                            }
                            ?>
                        >
                            <th><?php echo $i; ?></th>
                            <td><?php echo $value[0]->getRack() . "-" . $value[0]->getPosition(); ?></td>
                            <td><?php echo $article->getArticleNumber(); ?></td>
                            <td><?php echo $article->getArticleDesc(); ?></td>
                            <td><?php echo $value[1]; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                }else{
                    $warehouse = $warehousedb->getWarehouseLocation($_GET["filter"]);
                    $array = $warehousedb->getWarehouseLocationArticles($_GET["filter"]);
                    foreach ($array as $value){
                        ?>
                        <tr
                            <?php
                            if($value[1] <= $value[0]->getMinimumLevel()){
                                ?>
                                class="table-danger"
                                <?php
                            }else if($value[1] <= $value[0]->getMinimumLevel()*1.2){
                                ?>
                                class="table-warning"
                                <?php
                            }else{
                                ?>
                                class="table-success"
                                <?php
                            }
                            ?>
                        >
                            <th><?php echo $i; ?></th>
                            <td><?php echo $warehouse->getRack() . "-" . $warehouse->getPosition(); ?></td>
                            <td><?php echo $value[0]->getArticleNumber(); ?></td>
                            <td><?php echo $value[0]->getArticleDesc(); ?></td>
                            <td><?php echo $value[1]; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                }


                ?>
                </tbody>
            </table>
            <?php
        }
        ?>

    </div>
</form>