<?php

Class PositionArticleDAO extends AbstractDAO {

    function __construct() {
        
    }

    function getPositionArticle() {
        $this->doConnect();
        $stmt = $this->conn->prepare("");

        $this->closeConnect();
    }

    function setPositionArticle() {
        $this->doConnect();
        $stmt = $this->conn->prepare("");
        
        $this->closeConnect();
    }

}
