<?php

Class Voucher {

    protected $num;
    protected $party; //Debitor Kreditor
    protected $createDate;
    protected $articles = array();

    function __construct($num, $party, $create, $articles) {
        $this->num = $num;
        $this->party = $party;
        $this->createDate = $create;
        $this->articles = $articles;
    }

    function getNum() {
        return $this->num;
    }

    function getParty() {
        return $this->party;
    }

    function getCreateDate() {
        return $this->createDate;
    }

    function setVoucher($num, $party, $create) {
        $this->num = $num;
        $this->party = $party;
        $this->createDate = $create;

        //to do DB set
    }

    function insertArticleInOffer($article) {
        array_push($this->articles, $article);
    }

    function getArticles() {
        return $this->articles;
    }

}
