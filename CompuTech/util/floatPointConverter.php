<?php

Class floatPointConverter {

    function floatFromDB($betrag) {
        $betrag = $betrag / 100;
        return $betrag;
    }

    function floatToDB($betrag) {
        $betrag = str_replace(",", ".", $betrag);
        $betrag = $betrag * 100;
        return $betrag;
    }

}
