<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 24.05.2018
 * Time: 18:40
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/AbstractDAO.php';

class UserDAO extends AbstractDAO
{



    public function __construct()
    {
    }

    function getUser($usernamePara, $pwPara)
    {

        $username = null;
        $password = null;
        $firstname = null;
        $lastname = null;
        $adressId = null;

        $this->doConnect();
        $call = $this->conn->prepare("SELECT username, password, firstname, lastname, adressId FROM USER WHERE username = ? AND password = ? ORDER BY FLUGSTUNDEN ASC");
        $call->bind_param('ss', $usernamePara, $pwPara);
        $call->execute();
        $call->bind_result($username, $password, $firstname, $lastname, $adressId );

        $call->fetch();
        $user = new User($username, $password, $firstname, $lastname, $adressId);

        return $user;


        //$flugzeug[] = new User($row['username'],$row['password'],$row['firstname'], $row['lastname'], $row['adressId']);



    }

    function getTestUser(){

        $username = 'Franz';
        $password = '1234';
        $firstname = null;
        $lastname = null;
        $adressId = null;
        $user = new User($username, $password, $firstname, $lastname, $adressId);

        return $user;
    }


}

?>