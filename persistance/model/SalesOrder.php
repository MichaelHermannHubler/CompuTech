<?php

class SalesOrder {

    protected $id;
    protected $firstn;
    protected $lastn;
    protected $street;
    protected $postal;
    protected $city;
    protected $dateCreated;
    protected $paid;

    function __construct($id, $firstn, $lastn, $street, $postal, $city, $dateCreated, $paid) {
        $this->id = $id;
        $this->firstn = $firstn;
        $this->lastn = $lastn;
        $this->street = $street;
        $this->postal = $postal;
        $this->city = $city;
        $this->dateCreated = $dateCreated;
        $this->paid = $paid;
    }

    function getId() {
        return $this->id;
    }

    function getFirst() {
        return $this->firstn;
    }

    function getLast() {
        return $this->lastn;
    }

    function getStreet() {
        return $this->street;
    }

    function getPostal() {
        return $this->postal;
    }

    function getCity() {
        return $this->city;
    }

    function getDateCreated() {
        return $this->dateCreated;
    }

    function getPaid() {
        return $this->paid;
    }

    public function __get($val)
    {
        if (property_exists($this, $val)) {
            return $this->$val;
        }
    }

}


?>
