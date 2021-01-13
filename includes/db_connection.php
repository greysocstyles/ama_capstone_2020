
<?php

$host = '127.0.0.1';
$user = 'root';
$password = '2920852_Socratesbinos';
$database = 'ama';

$connect = null;

try {

	$connect = mysqli_connect($host, $user, $password, $database);

} catch (Exception $e) {

	echo $e->getMessage();
}
