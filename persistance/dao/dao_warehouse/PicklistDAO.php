<?php
//include '../../model/Picklist.php';
//include '../dao_purchase/ArticleDAO.php';

Class PicklistDAO extends AbstractDAO
{

    function __construct() { }

    function getPicklist($id)
    {
        $this->doConnect();
        $stmt = $this->conn->prepare("SELECT ID, Number, Completed from picklist where id = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();

        $id = "";
        $number = "";
        $completed = 0;
        $stmt->bind_result($id, $number, $completed);

        if($stmt->fetch())
        {
            $picklist = new Picklist($id, $number, $completed);
        }

        $this->closeConnect();
        return $picklist;
    }

    function getPicklists()
    {
        $this->doConnect();
        $stmt = $this->conn->prepare("SELECT ID, Number, Completed from picklist");

        $stmt->execute();

        $id = "";
        $number = "";
        $completed = 0;
        $stmt->bind_result($id, $number, $completed);

        $picklists =  array();

        while($stmt->fetch())
        {
            $picklist = new Picklist($id, $number, $completed);

            array_push($picklists, $picklist);
        }

        $this->closeConnect();
        return $picklists;
    }

    function getPicklistArticles($picklistID)
    {
        $this->doConnect();
        $stmt = $this->conn->prepare("SELECT ArticleID, Quantity, Completed from picklistarticle where picklistid = ?");
        $stmt->bind_param("i", $picklistID);

        $stmt->execute();

        $articleID = 0;
        $quantity = 0;
        $completed = false;
        $stmt->bind_result($articleID, $quantity, $completed);

        $articleArray = array();

        while($stmt->fetch())
        {
            if(is_null($completed) || $completed == 0) $completed = false;
            else $completed = true;

            $articleGetter = new ArticleDAO();
            $article = $articleGetter->getArticle($articleID);

            $articleArrayEntry = array($article, $quantity, $completed);

            array_push($articleArray, $articleArrayEntry);
        }

        $this->closeConnect();
        return $articleArray;
    }

    function getNextNumber(){
        $this->doConnect();
        $stmt = $this->conn->prepare("select concat( date_format(CURRENT_DATE, \"%Y/%m/%d/\"), right( concat( \"0000\", cast( COALESCE(( select max(substring(number, 12, 4)) from picklist where substring(number, 1, 10) = date_format(CURRENT_DATE, \"%Y/%m/%d\") ), 0) + 1 as char)), 4))");

        $stmt->execute();

        $number = "";
        $stmt->bind_result($number);

        if ($stmt->fetch()) {
            return $number;
        }
        return null;
    }

    function save($picklist){
        $this->doConnect();

        $id = $picklist->getId();
        $number = $picklist->getNumber();

        if(is_null($id) || $id <= 0){
            $call = $this->conn->prepare("insert into picklist (ID, Number) VALUES(null, ?)");
            $call->bind_param('s', $number);

            $call->execute();
            $last_id= $call->insert_id;
            $call->fetch();

            foreach ($picklist->getArticles() as $article) {
                $articleID = $article[0]->getID();
                $call = $this->conn->prepare("insert into picklistArticle (PicklistID, ArticleID, Quantity) VALUES(?, ?, ?)");
                $call->bind_param('iii', $last_id, $articleID, $article[1]);
                $call->execute();
                $call->fetch();
            }
            $this->closeConnect();
        }
    }

    function setPosCompleted($picklistID, $articleId, $quantity){
        $this->doConnect();

        $warehousLocationDb = new WarehouseLocationDAO();
        $warehousLocationDb->removeStock(null, $articleId, $quantity);

        $call = $this->conn->prepare("update picklistarticle set completed = 1 where picklistid = ? and articleid = ? and quantity = ? and coalesce(completed, 0) = 0");
        $call->bind_param('iii', $picklistID, $articleId, $quantity);

        $call->execute();
        $this->closeConnect();
    }

    function setCompleted($picklistID){
        $this->doConnect();

        $call = $this->conn->prepare("update picklist set completed = 1 where id = ?");
        $call->bind_param('i', $picklistID);

        $call->execute();
        $this->closeConnect();
    }
}
