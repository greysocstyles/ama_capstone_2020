<?php

if (isset($_POST['delete_degree']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$delete_id = $_POST['delete_id'];
	$delete_degree = query("DELETE from degree_list where id = '$delete_id'");

	if ($delete_degree) {
		$_SESSION['msg'] = 'Degree has been deleted.';
		$_SESSION['alert'] = 'alert-danger';
		header('Location: index.php?menu=degree_list');
		exit;
	}
}
