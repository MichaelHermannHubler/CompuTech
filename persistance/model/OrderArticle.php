<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 09.06.2018
 * Time: 16:49
 */

class OrderArticle
{

    private $id;
    private $articleId;
    private $orderId;
    private $quantityOrdered;
    private $quantityDelivered;
    private $price;
    private $defective;

    /**
     * OrderArticle constructor.
     * @param $id
     * @param $articleId
     * @param $orderId
     * @param $quantityOrdered
     * @param $price
     * @param $defective
     */
    public function __construct($id, $articleId, $orderId, $quantityOrdered, $price)
    {
        $this->id = $id;
        $this->articleId = $articleId;
        $this->orderId = $orderId;
        $this->quantityOrdered = $quantityOrdered;
        $this->price = $price;
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
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @param mixed $articleId
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getQuantityOrdered()
    {
        return $this->quantityOrdered;
    }

    /**
     * @param mixed $quantityOrdered
     */
    public function setQuantityOrdered($quantityOrdered)
    {
        $this->quantityOrdered = $quantityOrdered;
    }

    /**
     * @return mixed
     */
    public function getQuantityDelivered()
    {
        return $this->quantityDelivered;
    }

    /**
     * @param mixed $quantityDelivered
     */
    public function setQuantityDelivered($quantityDelivered)
    {
        $this->quantityDelivered = $quantityDelivered;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDefective()
    {
        return $this->defective;
    }

    /**
     * @param mixed $defective
     */
    public function setDefective($defective)
    {
        $this->defective = $defective;
    }




}