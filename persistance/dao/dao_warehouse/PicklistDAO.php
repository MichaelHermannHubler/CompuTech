<?php
//include '../../model/Picklist.php';
//include '../dao_purchase/ArticleDAO.php';

Class PicklistDAO extends AbstractDAO
{

    function __construct() { }

    function getPicklists()
    {
        $this->doConnect();
        $stmt = $this->conn->prepare("SELECT ID, Number from picklist");
        
        $stmt->execute();

        $id = "";
        $number = "";
        $stmt->bind_result($id, $number);

        $picklists =  array();

        while($stmt->fetch())
        {
            $picklist = new Picklist($id, $number);

            array_push($picklists, $picklist);
        }

        $this->closeConnect();
        return $picklists;
    }

    function getPicklistArticles($picklistID)
    {
        $this->doConnect();
        $stmt = $this->conn->prepare("SELECT ArticleID, Quantity from picklistarticle where picklistid = ?");
        $stmt->bind_param("i", $picklistID);

        $stmt->execute();

        $articleID = 0;
        $quantity = 0;
        $stmt->bind_result($articleID, $quantity);

        $articleArray = array();

        while($stmt->fetch())
        {
            $articleGetter = new ArticleDAO();
            $article = $articleGetter->getArticle($articleID);

            $articleArrayEntry = array($article, $quantity);

            array_push($articleArray, $articleArrayEntry);
        }

        $this->closeConnect();
        return $articleArray;
    }

    function getNextNumber(){
        $this->doConnect();
        $stmt = $this->conn->prepare("select concat(date_format(CURRENT_DATE, \"%Y/%m/%d/\"), right(concat(\"0000\", cast((max(substring(number, 12, 4)) + 1) as char)), 4)) from picklist where substring(number, 1, 10) = date_format(CURRENT_DATE, \"%Y/%m/%d\")");

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
}
