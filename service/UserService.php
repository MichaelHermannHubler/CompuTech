<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 24.05.2018
 * Time: 18:38
 */
include "../persistance/dao/UserDAO.php";

class UserService
{



    function authUser($username, $pw)
    {


        $userDAO = new UserDAO();
        //FIXME: ADD EXCEPTION HANDLIG darf nur ein Wert zurückkehren.
        $result = $userDAO->getUser($username, $pw);


        return $result;



    }


}