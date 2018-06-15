<?php
include "../../service/UserService.php";

if (!empty($_GET['register']) && !empty($_GET['username']) && !empty($_GET['pw']) && !empty($_GET['vorname']) && !empty($_GET['nachname'])) {
    $userService = new UserService();

    if ($userService->searchIfUserExist($_GET['username'])) {
        throw new Exception("User exist already");
    } else {
        $userService->setUser($_GET['username'], $_GET['pw'], $_GET['vorname'], $_GET['nachname']);
    }
}
?>

<form method="GET">
    <p>Bitte geben Sie Ihre Daten ein</p>
    <div class="form-row">
        <label for="username">Username:</label>
        <input type="text" name="username" size="15" required >
        <label for="pw">Passwort:</label>
        <input type="password" name="pw" size="15" required>        
    </div>
    <div class="form-row">
        <label for="vorname">Vorname:</label>
        <input type="text" name="vorname" size="15" required>
        <label for="nachname">Nachname:</label>
        <input type="text" name="nachname" size="15" required>
    </div>
    <div class="form-row">
        <input type="submit" name="register" value="submit">
    </div>
</form>

