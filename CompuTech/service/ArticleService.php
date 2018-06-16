<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 04.06.2018
 * Time: 16:14
 */

class ArticleService
{

    /* function getArticle($articleList)
     {



         $articleDAO = new ArticleDAO();
         $articles = array();
         foreach ($articleList as $entry){
             array_push($articles, $articleDAO->getArticle($entry->getArticleId()));
         }
         return $articles;
     }

    */

    function getArticles($filter)
    {


        $articleDAO = new ArticleDAO();
        return $articleDAO->getArticlesByFilter($filter);

    }


    function processOrder($articleDTOList, $versand, $liefer)
    {


        $result = $this->checkAvailability($articleDTOList);


        if (is_array($result) ){
            //create order
            $orderDAO = new OrderDAO();
            $orderArticleDAO = new OrderArticleDAO();
            $order = $orderDAO->createOrder("123456");
            $articles = array();
            $articleDAO = new ArticleDAO();

            foreach ($articleDTOList as $item) {

                $orderArticleDAO->createOrderArticle($item->getArticleId, $order->getId(), $item->getAmount(), $item->getPrice());

            }

            //create bill
            return true;
        }else{

            return $result;
        }



    }

    private function checkAvailability($articleDTOList)
    {

        $articles = array();
        $articleDAO = new ArticleDAO();
        foreach ($articleDTOList as $item) {

            $article = $articleDAO->getArticle($item->getArticleId());
            if ($article->getArticleNumber()<$item->getAmount()){
                echo "not available";

                return  $item->getArticleDesc();

            }
            else{

                $articles[]=$article;
            }

        }
        echo "available";
        return $articles;


    }
}