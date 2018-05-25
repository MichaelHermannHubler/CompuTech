<?php

Class PositionArticleDAO extends AbstractDAO{
    
    function __construct() {
        
    }
    
    function getPositionArticle(){
        $this->doConnect();
        
        $this->closeConnect();
    }
    
    function setPositionArticle() {
        $this->doConnect();
        
        $this->closeConnect();
    }
}

