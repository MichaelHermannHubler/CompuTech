<?php
session_start();
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
        <nav>


        </nav>

        <main>
            <h1>HELLO WORLD!</h1>

            <?php
            if (empty($_SESSION['user'])) {
                require "controller/loginController.php";
            }

            if (!empty($_SESSION['user'])) {
                include './controller/DepartmentController/PurchaseController.php';
            }


            if (!empty($_GET['menu'])) {
                $_SESSION['menu'] = $_GET['menu'];
               
            }

            if (!empty($_SESSION['menu'])) {
                if ($_GET['menu'] == "offer") {
                    include_once './controller/offerController.php';
                } else if ($_GET['menu'] == "order") {
                    echo "Order";
                } else {
                    include_once './controller/stockListController.php';
                }
            }
            ?>



        </main>


        <footer>



        </footer>
    </body>
</html>
