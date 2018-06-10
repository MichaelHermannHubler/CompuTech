<?php
require_once '../../persistance/dao/AbstractDAO.php';

Class ArticleGroupDAO extends AbstractDAO {

    function __construct() {
        
    }

    function setArticleGroup($id, $name, $desc) {
        $this->doConnect();

        if ($id == null) {
            $stmt = $this->conn->prepare("insert into articlegroup (Name, Description) values (?,?)");
            $stmt->bind_param("ss", $name, $desc);
        } else {
            $stmt = $this->conn->prepare("update articlegroup set Name = ?, Description = ? where ID = ?");
            $stmt->bind_param("ssi", $name, $desc, $id);
        }

        $stmt->execute();

        if ($id == null && $stmt->fetch()) {

            $id = mysqli_insert_id($stmt);
        }

        $this->closeConnect();

        return $id;
    }

    function getArtikelGroupName($id) {
        $this->doConnect();

        $stmt = $this->conn->prepare("Select Name from articlegroup where ID = ?");

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $stmt->bind_result($name);

        if ($stmt->fetch()) {
            $name = $name;
        }

        $this->closeConnect();
        return $name;
    }

    function getArtikelGroupID($name) {
        $this->doConnect();
        $name = utf8_decode($name);

        $stmt = $this->conn->prepare("Select ID from articlegroup where Name = ?");

        $stmt->bind_param("s", $name);

        $stmt->execute();

        $stmt->bind_result($id);

        if ($stmt->fetch()) {
            $id = $id;
        }

        $this->closeConnect();
        return $id;
    }

    function getAllArtikleGroup() {
        $this->doConnect();

        $stmt = $this->conn->prepare("select ID, Name, Description from articlegroup");

        $stmt->execute();

        $stmt->bind_result($id, $name, $desc);

        $articleGroups = array();
        while ($stmt->fetch()) {
            $articleGroup = new ArticleGroup($id, $name, $desc);
            array_push($articleGroups, $articleGroup);
        }

        $this->closeConnect();
        return $articleGroups;
    }

}
