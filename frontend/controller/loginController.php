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






    echo"<div class=\"form-group\">";
if (empty($_SESSION['signedIn'])) {
    echo"<form method=\"POST\">";
    echo"<label for=\"username\">Benutzername:</label>";
    echo"</br>";
    echo"<input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"Benutzername\" required>";
    echo"<small id=\"emailHelp\" class=\"form-text text-muted\">Ihren Benutzernamen finden Sie in der Registrierungsmail.</small>";
    echo"</br>";
    echo"<label for=\"pw\">Passwort:</label>";
    echo"</br>";
    echo"<input type=\"password\" class=\"form-control\" name=\"pw\" placeholder=\"Passwort\" required>";
    echo"</br>";

    echo"<input type=\"submit\" class=\"btn btn-outline-secondary my-2 my-sm-0\" name=\"submit\" value=\"Bestätigen\">";
    echo"</form>";
    echo"</div>";
    echo"</br>";
    echo"<div>";
    echo "Sie haben noch keinen Account?";
    echo"</br>";
    echo "<a class=\"btn btn-outline-secondary my-2 my-sm-0\" href=\"./controller/registerController.php\">Zur Registrierung</a>";
    echo"</div>";
}
?>