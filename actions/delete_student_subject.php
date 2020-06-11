<?php

if (isset($_POST['delete_student_subject']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$delete_id = $_POST['delete_id'];
	$student_id = $_POST['student_id'];
	$delete_student_subject = query("delete from student_subject_list where id = '$delete_id'");

	if ($delete_student_subject) {
		$_SESSION['msg'] = 'Subject has been deleted.';
		$_SESSION['alert'] = 'alert-danger';
		header('Location: index.php?view=student_subject&view_id=' . $student_id);
		exit;
	}
}
