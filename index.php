<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP Mail</title>
    </head>
    <body>
        <?php
         $empf = "l.kreidl1210@gmail.com";
         $betreff = "Neuer Eintrag";
         $from = "From: Lukas Kreidl <l.kreidl1210@gmail.com>\n";
         $from .= "Reply-To: katharinakienast@gmail.com\n";
         $from .="Content-Type: text/html\n";
         $text = "<h1>Lukas</h1><p style=\"color:darkblue;\">Du hast eine neue Mail bekommen</p>";
         
         
         mail($empf, $betreff, $text, $from);
         
        ?>
    </body>
</html>
