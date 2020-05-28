<?php

if (isset($_POST['delete_student']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$delete_id = $_POST['delete_id'];
	$delete_student = query("delete from student_list where id = '$delete_id'");

	if ($delete_student) {
		$_SESSION['msg'] = 'Student has been deleted.';
		$_SESSION['alert'] = "alert-danger";
		header('Location: index.php?menu=student_list');
		exit;
	}
		 
}
