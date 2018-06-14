<?php

/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 24.05.2018
 * Time: 18:40
 */
class UserDAO extends AbstractDAO {

    public function __construct() {
        
    }

    function getUser($usernamePara, $pwPara) {

        $username = null;
        $password = null;
        $firstname = null;
        $lastname = null;
        $adressId = null;

        $this->doConnect();
        $call = $this->conn->prepare("SELECT Username, PasswortMD5, FirstName, LastName, AddressID FROM USER WHERE Username = ? AND PasswortMD5 = ?");
        $call->bind_param('ss', $usernamePara, $pwPara);
        $call->execute();
        $call->bind_result($username, $password, $firstname, $lastname, $adressId);

        $call->fetch();
        $user = new User($username, $password, $firstname, $lastname, $adressId);

        $this->closeConnect();
        return $user;


        //$flugzeug[] = new User($row['username'],$row['password'],$row['firstname'], $row['lastname'], $row['adressId']);
    }

    function getTestUser() {

        $username = 'Franz';
        $password = '1234';
        $firstname = null;
        $lastname = null;
        $adressId = null;
        $user = new User($username, $password, $firstname, $lastname, $adressId);

        return $user;
    }

    public function setUser($user, $pw, $first, $last) {
        $this->doConnect();

        $stmt = $this->conn->prepare("insert into user (Username, PasswortMD5, FirstName, LastName) values(?,?,?,?)");

        $stmt->bind_param("ssss", $user, $pw, $first, $last);

        $stmt->execute();

        $this->closeConnect();
    }

    function getIfUserExist($user) {

        $this->doConnect();
        $exist = false;

        $stmt = $this->conn->prepare("select ID from user where Username = ?");

        $stmt->bind_param("s", $user);

        $stmt->execute();

        if ($stmt->fetch()) {
            $exist = true;
        }

        $this->closeConnect();
        return $exist;
    }

}

?>