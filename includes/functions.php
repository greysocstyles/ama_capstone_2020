<?php

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


function year_trimester($num) {
	$output = null;
	switch ($num) {
		case 1:
			$output = $num . 'st';
			break;
		case 2: 
			$output = $num . 'nd';
			break;
		case 3: 
			$output = $num . 'rd';
			break;
		
		default: 
			$output = $num . 'th';
	}
	return $output;
}

function grade_status($grade) {
	$passing_grades = ['A+','A','A-','B+','B','B-','C+','C','C-'];
	$is_passing = in_array($grade, $passing_grades);
	$status = null;

	if($grade == $is_passing) {
		$status = 'PASS';

	} elseif($grade == 'F') {
		$status = 'FAIL';

	} elseif($grade == 'IC') {
		$status = 'INCOMPLETE';

	} elseif($grade == 'IP') {
		$status = 'INPROGRESS';

	}
	return $status;
}

function escape($string) {
	global $connect;
	return mysqli_real_escape_string($connect, $string);
}

function dumper($var) {
	return die(var_dump($var));
}