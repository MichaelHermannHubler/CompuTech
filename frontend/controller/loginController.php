<?php

/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 24.05.2018
 * Time: 18:36
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/util/ArrayUtil.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/service/UserService.php';



if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (isset($_POST['username']) && isset($_POST['pw'])) {

    $userService = new UserService();

    $_SESSION['user'] = $userService->getAuthUser($_POST['username'], $_POST['pw']);
    if ($_SESSION['user'] != null) {
        $_SESSION['signedIn'] = true;
    }
    

}



/*
if (!empty($_SESSION['signedIn'])) {
    echo "<form method=\"post\">
	<label for=\"username\">Username:</label>
    <input type=\"text\" name=\"username\" required>
	<label for=\"pw\">PW:</label>
	<input type=\"password\" name=\"pw>\" required>
	<input type=\"submit\" name=\"submit\" value=\"submit\">
</form>";
}*/







if (empty($_SESSION['signedIn'])) {
    echo"<form method=\"POST\">";
    echo"<label for=\"username\">Username:</label>";
    echo"<input type=\"text\" name=\"username\" required>";
    echo"<label for=\"pw\">PW:</label>";
    echo"<input type=\"password\" name=\"pw\" required>";
    echo"<input type=\"submit\" name=\"submit\" value=\"submit\">";
    echo "<br/>";
    echo "<a href=\"./controller/registerController.php\"><button>Registrieren</button></a>";
    echo"</form>";
}
?>