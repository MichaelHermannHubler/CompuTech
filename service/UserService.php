<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 24.05.2018
 * Time: 18:38
 */
include $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/persistance/dao/dao_sales/UserDAO.php';

class UserService
{



    function getAuthUser($username, $pw)
    {


        $userDAO = new UserDAO();
        //FIXME: ADD EXCEPTION HANDLIG darf nur ein Wert zurückkehren.
        //$result = $userDAO->getUser($username, $pw);
        $result = $userDAO->getTestUser($username, $pw);


        return $result;



    }


}