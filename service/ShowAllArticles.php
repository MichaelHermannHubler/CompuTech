<?php
include_once '../persistance/dao/AbstractDAO.php';
    $user = "bpohn2";
    $pwd = "orcldbpwd";
    $host = "infdb.technikum-wien.at:1521/o10";
    
    // Create connection
    $conn = new mysqli($user, $pwd, $host/*,$DBNAME???*/);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT ID, Number, Name, RetailPrice FROM article;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        echo "<table><tr><th>ID</th><th>Number</th><th>Name</th><th>Retail Price</th></tr>";
    
	while ($row = mysqli_fetch_assoc($result)) {
            // output data of each row
            echo "<tr><td>".$row["ID"]."</td><td>".$row["Number"]."</td><td>".$row["Name"]."</td><td>".$row["RetailPrice"]."</td></tr>";
        }
    }
    echo "</table>";
    
    echo "yes yes";

?>
