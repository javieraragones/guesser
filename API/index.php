<?php
//terminal /guesser
# php -S localhost:81 -t .\api\
// ctrl c 
require_once "guesser.php";

$guesserAPI = new GuesserAPI();
$guesserAPI->API();
