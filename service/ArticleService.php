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


    function processOrder($articleDTOList, $versand, $rechnung, $user)
    {


        $result = $this->checkAvailability($articleDTOList);


        if (is_array($result) ){
            //create order
            $orderDAO = new OrderDAO();
            $orderArticleDAO = new OrderArticleDAO();
            $order = $orderDAO->createOrder(rand(100000,999999));
            $articleDAO = new ArticleDAO();

            foreach ($articleDTOList as $item) {

                $orderArticleDAO->createOrderArticle($item->getArticleId(), $order->getId(), $item->getAmount(), $item->getPrice());
                $articleDAO->reduceAvaiabilityByNumber($item->getArticleId(), $item->getAmount());

            }

            $addressDAO = new AddressDAO();
            $versandID = $addressDAO->setAddress(null, $versand->getStreet(),$versand->getCity(),$versand->getPostalCode(), $versand->getCountryCode(), $versand->getName());


            //create bill
            $saleOrderDAO = new SalesOrderDAO();
            $articles = array();

            $rechnungID = $addressDAO->setAddress(null, $rechnung->getStreet(),$rechnung->getCity(),$rechnung->getPostalCode(), $rechnung->getCountryCode(), $rechnung->getName());

            $saleOrderDAO->createBill($versandID, $rechnungID, $order->getId(), $user);


            //reduce Article quantity



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
            if ($article->getReservedStock()<$item->getAmount()){
                return  $item->getArticleDesc();

            }
            else{

                $articles[]=$article;
            }

        }
        return $articles;


    }
}