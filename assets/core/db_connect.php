<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "tuinman";

$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


if ($con -> connect_errno) {
    echo "Failed to connect to MySQL: " . $con -> connect_error;
    exit();
}


define("BASEURL","http://localhost/klant-opdracht-module-4/");


function prettyDump ( $var ) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}