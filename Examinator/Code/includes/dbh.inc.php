<?php
$serverName = "localhost";
$dBUsername = "root";
$dBPasswort = "";
$dBName = "examinator";

$connection = mysqli_connect($serverName, $dBUsername,$dBPasswort,$dBName)
or die("Connection failed: " . mysqli_connect_error());
