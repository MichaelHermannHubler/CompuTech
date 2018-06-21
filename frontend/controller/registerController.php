<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../../service/UserService.php";

if (!empty($_GET['register']) && !empty($_GET['username']) && !empty($_GET['pw']) && !empty($_GET['vorname']) && !empty($_GET['nachname'])) {
    $userService = new UserService();

    if ($userService->searchIfUserExist($_GET['username'])) {
        echo "User exist already";
    } else {
        $_SESSION['user'] = $userService->setUser($_GET['username'], $_GET['pw'], $_GET['vorname'], $_GET['nachname']);
        $_SESSION['signedIn'] = true;
        $userDAO = new UserDAO;
        $permDAO = new UserPermissionsDAO;
        $user = $_SESSION['user'];
        $_SESSION['perm'] = $permDAO->getPermissions($userDAO->getUserID($_GET['username']));
        header("Location: http://localhost/Computech/frontend/index.php");
    }
}
?>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<div class="container">
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand">Computech GmbH</a>
    </nav>
</div>

<div class="container">
    </br>

    <form method="GET">
        <p>Bitte geben Sie Ihre Daten ein</p>
        <div class="form-row">
            <label for="username">Username:</label>
            <input type="text" name="username" size="15" class="form-control" required >
            <label for="pw">Passwort:</label>
            <input type="password" name="pw" size="15" class="form-control" required>        
        </div>
        <div class="form-row">
            <label for="vorname">Vorname:</label>
            <input type="text" name="vorname" size="15" class="form-control" required>
            <label for="nachname">Nachname:</label>
            <input type="text" name="nachname" size="15" class="form-control" required>
        </div>
        <div class="form-row">
            <input type="submit" name="register" class="btn btn-outline-secondary my-2 my-sm-0" value="submit">
        </div>
    </form>


