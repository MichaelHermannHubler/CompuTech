<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-light bg-light justify-content-between">
            <a class="navbar-brand">Computech GmbH</a>
        </nav>
    </div>
    <?php
    session_start();

    session_destroy();
    ?>
    <div class="container">
        </br>
        <h4>Sie sind jetzt ausgeloggt</h4>
        </br>  
        <a class="btn btn-outline-secondary my-2 my-sm-0" href='index.php'>Zurück zum Login</a>
    </div>
</body>

