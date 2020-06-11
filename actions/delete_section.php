<?php

if (isset($_POST['delete_section']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$delete_id = $_POST['delete_id'];
	$delete_section = query("DELETE from section_list where id = '$delete_id'");

	if ($delete_section) {
		$_SESSION['msg'] = 'Section has been deleted.';
		$_SESSION['alert'] = 'alert-danger';
		header('Location: index.php?menu=section_list');
		exit;
	}
}
