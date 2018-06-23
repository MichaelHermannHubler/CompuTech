
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<body>
 <div class="container">
        <nav class="navbar navbar-light bg-light justify-content-between">
            <a class="navbar-brand">Computech GmbH</a>
        </nav>
    </div>
</br>


 <div class="container">
<form action="CheckoutController.php" method="post">
    <div>
    <h2>Versanddetails</h2>


	<table  class="table table-bordered table-hover">
	<tr>
	<td>
    <label for="nameV">Name</label>
</td>
<td>
    <input required type="text" name="nameV"  />
</td>
</tr>
<tr>
<td>
    <label for="straseV">Straﬂe</label>
</td>
<td>
    <input required type="text" name="straseV" />
</td>
</tr>
<tr>
<td>
    <label for="plzV">PLZ</label>
</td>
<td>
    <input required type="text" name="plzV"  />
</td>
</tr>
<tr>
<td>
    <label for="stadtV">Stadt</label>
</td>
<td>
    <input required type="text" name="stadtV"  />
</td>
</tr>

<tr>
<td>
    <label for="landV">Land</label>
</td>
<td>
    <input required type="text" name="landV"  />
</td>
</tr>
</table>
    </div>


    <div>
    <h2>Rechnungsdetails</h2>

	<table  class="table table-bordered table-hover">
	<tr>
	<td>
    <label for="nameR">Name</label>
</td>
<td>
    <input required type="text" name="nameR"  />
</td>
</tr>
<tr>
<td>
    <label for="straseR">Straﬂe</label>
</td>
<td>
    <input required type="text" name="straseR" />
</td>
</tr>
<tr>
<td>
    <label for="plzR">PLZ</label>
</td>
<td>
    <input required type="text" name="plzR"  />
</td>
</tr>
<tr>
<td>
    <label for="stadtR">Stadt</label>
</td>
<td>
    <input required type="text" name="stadtR"  />
</td>
</tr>

<tr>
<td>
    <label for="landR">Land</label>
</td>
<td>
    <input required type="text" name="landR"  />
</td>
</tr>
</table>

<!--
    <label for="nameR">Name</label>
    <input required type="text" name="nameR"  />
    <label for="straseR">Stra√üe</label>
    <input required type="text" name="straseR" />
    <label for="plzR">PLZ</label>
    <input required type="text" name="plzR"  />
    <label for="landR">Land</label>
    <input required type="text" name="landR"  />
    <label for="stadtR">Stadt</label>
    <input required type="text" name="stadtR"  />
    </div>
-->
</br>    
<input type="submit" class="btn btn-outline-secondary" value="Zur ‹berpr¸fung">
</form>
</div>
</body>
