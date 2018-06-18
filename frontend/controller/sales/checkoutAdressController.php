
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>



<form action="CheckoutController.php" method="post">
    <div>
    <h2>Versanddetails</h2>

    <label for="nameV">Name</label>
    <input required type="text" name="nameV"  />
    <label for="straseV">Straße</label>
    <input required type="text" name="straseV" />
    <label for="plzV">PLZ</label>
    <input required type="text" name="plzV"  />
    <label for="landV">Land</label>
    <input required type="text" name="landV"  />
    <label for="stadtV">Stadt</label>
    <input required type="text" name="stadtV"  />
    </div>

    <div>
    <h2>Rechnungsdetails</h2>

    <label for="nameR">Name</label>
    <input required type="text" name="nameR"  />
    <label for="straseR">Straße</label>
    <input required type="text" name="straseR" />
    <label for="plzR">PLZ</label>
    <input required type="text" name="plzR"  />
    <label for="landR">Land</label>
    <input required type="text" name="landR"  />
    <label for="stadtR">Stadt</label>
    <input required type="text" name="stadtR"  />
    </div>


    <input type="submit" class="btn btn-outline-secondary" value="Zur Überprüfung">
</form>
