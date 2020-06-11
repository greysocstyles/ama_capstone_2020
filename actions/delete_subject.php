<?php

if (isset($_POST['delete_subject']) && $_SERVER[REQUEST_METHOD] == 'POST') {
	$delete_id = $_POST['delete_id'];
	$delete_subject = query("delete from subject_list where id = '$delete_id'");

	if ($delete_subject) {
		$_SESSION['msg'] = 'Subject has been deleted.';
		$_SESSION['alert'] = 'alert-danger';
		header('Location: index.php?menu=subject_list');
		exit;
	}
}
