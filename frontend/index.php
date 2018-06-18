<?php
include_once './includes.php';
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Computech</title>       
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="style/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="JavaScript/main.js"></script>

    </head>
    <body>
    <div class="container">
        <nav class="navbar navbar-light bg-light justify-content-between">
            <a class="navbar-brand">Computech GmbH</a>
        </nav>
    </div>

        <main>

            <?php
            if (empty($_SESSION['user'])) {
                require "controller/loginController.php";
            }

            if (!empty($_SESSION['user']) && empty($_SESSION['perm'])) {
                $user = $_SESSION['user'];
                $userDAO = new UserDAO;
                $permDAO = new UserPermissionsDAO;
                $_SESSION['perm'] = $permDAO->getPermissions($userDAO->getUserID($user->getUsername()));
            }

            if (!empty($_SESSION['user'])) {
                echo "<a href=\"./logout.php\"><button class=\"btn btn-primary\">Logout</button></a>";
            }
            if (!empty($_SESSION['perm'])) {
                if ($_SESSION['perm'] == 'ek') {
                    include './controller/DepartmentController/PurchaseController.php';
                    if (!empty($_GET['menu'])) {
                        $_SESSION['menu'] = $_GET['menu'];
                    }

                    if (!empty($_SESSION['menu'])) {
                        if ($_GET['menu'] == "offer") {
                            include_once './views/offers.php';
                        } else if ($_GET['menu'] == "order") {
                            include_once './views/orders.php';
                        } else {
                            include_once './controller/stockListController.php';
                        }
                    }
                } else if ($_SESSION['perm'] == 'lg') {
                    include './WarehouseHome.php';
                } else if ($_SESSION['perm'] == 'vk' || $_SESSION['perm'] == 'kd') {
                    include './controller/sales/ArticleListController.php';
                }else {
                    include './controller/DepartmentController/PurchaseController.php';
                }
            }
            ?>



        </main>


        <footer>



        </footer>
    </body>
</html>
