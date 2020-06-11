<?php

if (isset($_POST['delete_trimester_subject']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$delete_id = $_POST['delete_id'];
	$trimester_id = $_POST['trimester_id'];
	$delete_trimester_subject = query("delete from trimester_subject_list where id = '$delete_id'");

	if ($delete_trimester_subject) {
		$_SESSION['msg'] = 'Subject has been deleted.';
		$_SESSION['alert'] = 'alert-danger';
		header('location: index.php?view=trimester_subject' . '&view_id=' . $trimester_id);
		exit;
	}
}
