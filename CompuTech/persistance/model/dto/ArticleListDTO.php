<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 04.06.2018
 * Time: 14:17
 */

class ArticleListDTO
{

    private $articleId;
    private $amount;
    private $articleDesc;
    private $price;

    /**
     * ArticleListDTO constructor.
     * @param $articleId
     * @param $amount
     * @param $articleDesc
     * @param $price
     */
    public function __construct($articleId, $amount, $articleDesc, $price)
    {
        $this->articleId = $articleId;
        $this->amount = $amount;
        $this->articleDesc = $articleDesc;
        $this->price = $price;
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
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getArticleDesc()
    {
        return $this->articleDesc;
    }

    /**
     * @param mixed $articleDesc
     */
    public function setArticleDesc($articleDesc)
    {
        $this->articleDesc = $articleDesc;
    }



}