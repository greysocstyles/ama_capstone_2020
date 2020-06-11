<?php

if (isset($_POST['delete_petition']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$delete_id = $_POST['delete_id'];
	$delete_petition = query("DELETE from request_to_open_list where id = '$delete_id'");

	if ($delete_petition) {
		$_SESSION['msg'] = 'Subject has been deleted.';
		$_SESSION['alert'] = 'alert-danger';
		header('Location: index.php?menu=petition_list');
		exit;
	}
}
