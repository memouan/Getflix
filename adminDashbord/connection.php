<?php

$dbname = "mysql:host=localhost;dbname=getflixdb;charset=utf8"; // Data Source Name
$dbuser = 'root';
$dbpass = 'root';

$db = new PDO($dbname, $dbuser, $dbpass); // Start Connecting the database By PDO Class
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set the error mode to PDO::ERRMODE_EXCEPTION
