<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 09.06.2018
 * Time: 16:48
 */

class Order
{

    private $id;
    private $nummer;

    /**
     * Order constructor.
     * @param $id
     * @param $nummer
     */
    public function __construct($id, $nummer)
    {
        $this->id = $id;
        $this->nummer = $nummer;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNummer()
    {
        return $this->nummer;
    }

    /**
     * @param mixed $nummer
     */
    public function setNummer($nummer)
    {
        $this->nummer = $nummer;
    }




}