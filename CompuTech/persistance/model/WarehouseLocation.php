<?php

Class WarehouseLocation {

    private $id = 0;
    private $rack = "";
    private $position = "";

    function __construct($id, $rack, $position) {
        $this->id = $id;
        $this->rack = $rack;
        $this->position = $position;
    }

    function setWarehouseLocation($rack, $position) {
        if (!is_null($rack)) {
            $this->rack = $rack;
        } else {
            $error =  "An Rack must be chosen";
        }

        if (!is_null($position)) {
            $this->rack = $position;
        } else {
            $error =  "An Position must be chosen";
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRack()
    {
        return $this->rack;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }


}
