<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 24.05.2018
 * Time: 18:40
 */


class UserDAO extends AbstractDAO
{



    public function __construct()
    {
    }

    function getUser($username, $pw)
    {


        $this->doConnect();
        $call = $this->conn->prepare("SELECT username, password, firstname, lastname, adressId FROM USER WHERE username = ? AND password = ? ORDER BY FLUGSTUNDEN ASC");
        $call->bind_param('ss', $username, $pw);
        $call->execute();
        $call->bind_result($user, $password, $first, $last, $adress);

        $call->fetch();
        $user = new User($user, $password, $first, $last, $adress);

        return $user;


        //$flugzeug[] = new User($row['username'],$row['password'],$row['firstname'], $row['lastname'], $row['adressId']);



    }


}

?>