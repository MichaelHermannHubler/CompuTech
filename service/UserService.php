<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 24.05.2018
 * Time: 18:38
 */
include_once $_SERVER['DOCUMENT_ROOT'].'/computech/frontend/includes.php';
class UserService
{



    function getAuthUser($username, $pw)
    {


        $userDAO = new UserDAO();
        //FIXME: ADD EXCEPTION HANDLIG darf nur ein Wert zurückkehren.
        //$result = $userDAO->getUser($username, $pw);
        $result = $userDAO->getUser($username, $pw);

        

        

        return $result;



    }
    
    function setUser($username, $pw, $first, $last){
        
        $userDAO = new UserDAO();
        
        $userDAO->setUser($username, $pw, $first, $last);
        
    }
    
    function searchIfUserExist($user){
        
        $userDAO = new UserDAO();
        
        $result = $userDAO->getIfUserExist($user);
        
        return $result;
    }


}
