<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 24.05.2018
 * Time: 18:36
 */

$_SESSION['signedIn']=false;
$_SESSION['user']=null;



include "../service/UserService.php";


if (isset($_POST['username']) && isset($_POST['pw'])){

	$userService = new UserService();

    $_SESSION['user'] = $userService->getAuthUser($_POST['username'],$_POST['pw']);
	if ($_SESSION['user'] != null){
        $_SESSION['signedIn'] = true;
        var_dump($_SESSION['user']);
        
    }
}






if(empty($_SESSION['signedIn'])){
    echo"<form method=\"POST\">";
	echo"<label for=\"username\">Username:</label>";
    echo"<input type=\"text\" name=\"username\" required>";
	echo"<label for=\"pw\">PW:</label>";
	echo"<input type=\"password\" name=\"pw\" required>";
	echo"<input type=\"submit\" name=\"submit\" value=\"submit\">";
        echo "<br/>";
        echo "<button><a href=\"./controller/registerController.php\">Registrieren</a></button>";
echo"</form>";
}

