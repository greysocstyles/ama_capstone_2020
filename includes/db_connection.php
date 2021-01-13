<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ama';

$connect = null;

try {

	$connect = mysqli_connect($host, $user, $password, $database);

} catch (Exception $e) {

	echo $e->getMessage();
}