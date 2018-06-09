<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 04.06.2018
 * Time: 16:14
 */
include $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_purchase/ArticleDAO.php';
class ArticleListService
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
}