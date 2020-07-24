<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ama';

$connect = mysqli_connect($host, $user, $password, $database);

if(!$connect) {

	die ('Unable to connect' . ' ' . mysqli_connect_error($connect));

}

function query($sql) {
	global $connect;
	$result = mysqli_query($connect, $sql);
	return $result;
}

function multiple_insert($query, $values) {
	$sql = $query;
	$sql .= implode(", ", $values);
	return query($sql);
}

function year_trimester($x) {
	if($x == 1){
		return $x . 'st';

	} elseif($x == 2) {
		return $x . 'nd';

	} elseif($x == 3){
		return $x . 'rd';

	} else {
		return $x . 'th';
	}

}

function grade_status($grade) {
	$passing_grades = array('A+','A','A-','B+','B','B-','C+','C','C-');
	$x = in_array($grade, $passing_grades);

	if($grade == $x) {
		return 'PASS';

	} elseif($grade == 'F') {
		return 'FAIL';

	} elseif($grade == 'IC') {
		return 'INCOMPLETE';

	} elseif($grade == 'IP') {
		return 'INPROGRESS';

	}

}

function escape($string) {

	return mysqli_real_escape_string($connect, $string);

}
