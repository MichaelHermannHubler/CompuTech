<?php

Class Voucher {

    protected $num;
    protected $party; //Debitor Kreditor
    protected $createDate;

    function __construct($num, $party, $create) {
        $this->num = $num;
        $this->party = $party;
        $this->createDate = $create;
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

}
