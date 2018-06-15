<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 24.05.2018
 * Time: 18:36
 */



include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/util/ArrayUtil.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/service/UserService.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/persistance/model/dto/ArticleListDTO.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CompuTech/persistance/dao/dao_purchase/ArticleDAO.php';

session_start();
$_SESSION['signedIn']=true;

if (isset($_POST['username']) && isset($_POST['pw'])){

	$userService = new UserService();

    $_SESSION['user'] = $userService->getAuthUser($_POST['username'],$_POST['pw']);
	if ($_SESSION['user'] != null){
        $_SESSION['signedIn'] = true;
        echo "LoggedIN!!";
        var_dump($_SESSION);
    }
}




if (!$_SESSION['signedIn'])
echo "<form method=\"post\">
	<label for=\"username\">Username:</label>
    <input type=\"text\" name=\"username\" required>
	<label for=\"pw\">PW:</label>
	<input type=\"password\" name=\"pw>\" required>
	<input type=\"submit\" name=\"submit\" value=\"submit\">
</form>";
?>





