<?php

if (isset($_POST['edit_section']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$edit_id = $_POST['edit_id'];
	$section = strtoupper($_POST['section_code']);

	if (empty($section)) {
		$msg = 'Please fill in all required fields.';
		$alert_class = 'alert-danger';

	} elseif (!preg_match('/[a-zA-Z0-9]{4,}+/', $section)) {
		$msg = 'Invalid Section code.';
		$alert_class = 'alert-danger';
		
	} else {
		$update_section = query("update section_list set section_code = '$section' where id = '$edit_id'");

		if ($update_section) {
			$_SESSION['msg'] = 'Edit Success!';
			$_SESSION['alert'] = 'alert-info';
			header('Location: index.php?menu=section_list');
			exit;
		}
	}
}
