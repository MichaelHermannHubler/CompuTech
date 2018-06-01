<?php

include '../dao/dao_purchase/ArticleGroupDAO.php';

class ArticleGroup {

    private $id = null;
    private $name = "";
    private $desc = "";

    function __construct($id, $name, $desc) {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
    }

    function setArticleGroup($id, $name, $desc) {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;

        $db = new ArticleGroupDAO;

        if ($this->id == null) {
            $this->id = $db->setArticleGroup($this->id, $this->name, $this->desc);
        } else {
            $db->setArticleGroup($this->id, $this->name, $this->desc);
        }
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDesc() {
        return $this->desc;
    }

}
