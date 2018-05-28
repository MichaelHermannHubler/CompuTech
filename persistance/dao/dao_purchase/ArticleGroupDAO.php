<?php

Class ArticleGroupDAO extends AbstractDAO{
    
    function __construct() {
        
    }
    
    function getArtikelGroupName($id) {
        $this->doConnect();
        
        $stmt = $this->conn->prepare("Select Name from articlegroup where ID = ?");
        
        $stmt->bind_param("i", $id);
        
        $stmt->execute();
        
        $stmt->bind_result($name);
        
        if($stmt->fetch()){
            $name = $name;
        }
        
        $this->closeConnect();
        return $name;
    }
    
    function getArtikelGroupID($name) {
        $this->doConnect();
        
        $stmt = $this->conn->prepare("Select ID from articlegroup where Name = ?");
        
        $stmt->bind_param("", $name);
        
        $stmt->execute();
        
        $stmt->bind_result($id);
        
        if($stmt->fetch()){
            $id = $id;
        }
        
        $this->closeConnect();
        return $id;
    }
}

