<?php

if (isset($_POST['delete_petition_student']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$delete_id = $_POST['delete_id'];
	$petition_id = $_POST['petition_id'];
	$delete_petition_student = query("delete from request_to_open_student_list where id = '$delete_id'");

	if ($delete_petition_student) {
		$_SESSION['msg'] = 'Student has been deleted.';
		$_SESSION['alert'] = 'alert-danger';
		header('Location: index.php?view=petition_student&view_id=' . $petition_id);
		exit;
	}
}
