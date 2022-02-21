<?php

$host = "";
$user = "";
$pass = "";
$dbname = "";
$port = "";

$conn = new PDO("mysql:host=$host;port=$port;dbname=".$dbname, $user, $pass);
