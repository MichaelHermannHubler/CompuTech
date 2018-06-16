<?php

Class Picklist {

    private $id = 0;
    private $number = "";
    private $completed = 0;
    private $articles = array();

    function __construct($id, $number, $completed) {
        $this->id = $id;
        $this->number = $number;
        $this->completed = $completed;
    }

    function addArticle($articleID, $quantity) {
        $error = null;
        if (is_null($articleID)) {
            $error =  "An Article must be chosen";
        }

        if (is_null($quantity)) {
            $error =  "A Quantity must be chosen";
        }

        $articleGetter = new ArticleDAO();

        if(is_null($error)) {
            array_push($this->articles, array($articleGetter->getArticle($articleID), $quantity));
        }else{
            return error;
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return int
     */
    public function getCompleted()
    {
        if($this->completed == 1) return true;
        return false;
    }

    /**
     * @return array
     */
    public function getArticles()
    {
        return $this->articles;
    }

}
