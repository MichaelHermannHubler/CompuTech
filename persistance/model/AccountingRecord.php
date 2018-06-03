<?php

Class AccountingRecord {

    private $id = 0;
    private $warehouseLocationSrc = 0;
    private $warehouseLocationDest = 0;
    private $articleID = 0;
    private $quantityMoved = 0;
    private $type = 0;

    function __construct($id, $warehouseLocationSrc, $warehouseLocationDest, $articleID, $quantityMoved, $type) {
        $this->id = $id;
        $this->warehouseLocationSrc = $warehouseLocationSrc;
        $this->warehouseLocationDest = $warehouseLocationDest;
        $this->articleID = $articleID;
        $this->quantityMoved = $quantityMoved;
        $this->type = $type;
    }

    function setAccountingRecord($warehouseLocationSrc, $warehouseLocationDest, $articleID, $quantityMoved, $type) {
        $this->articleDesc = $warehouseLocationSrc;
        $this->articleGroup = $warehouseLocationDest;

        if (!is_null($articleID)) {
            $this->articleID = $articleID;
        } else {
            $error =  "An Article must be chosen";
        }

        if (is_null($quantityMoved)) {
            $error =   "The moved quantity must be chosen";
        }elseif ($quantityMoved <= 0){
            $error =   "The moved quantity must be greather than zero";
        } else {
            $this->articleID = $articleID;
        }

        if (!is_null($type)) {
            $this->type = $type;
        } else {
            $error =   "An accounting record type must be chosen";
        }

        if(is_null($error)) {

            //to do Datenbank set
        }else{
            return error;
        }
    }

    /**
     * @return int
     */
    public function getWarehouseLocationSrc()
    {
        return $this->warehouseLocationSrc;
    }

    /**
     * @return int
     */
    public function getWarehouseLocationDest()
    {
        return $this->warehouseLocationDest;
    }

    /**
     * @return int
     */
    public function getArticleID()
    {
        return $this->articleID;
    }

    /**
     * @return int
     */
    public function getQuantityMoved()
    {
        return $this->quantityMoved;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

}
