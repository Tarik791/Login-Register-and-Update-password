<?php
//Funckija koja če samo u osnovi sanirati podatke kako bismo mogli isporučiti
function escape($string){

    //Convert all applicable characters to HTML entities
    return htmlentities($string, ENT_QUOTES, 'UTF-8');


}



?>