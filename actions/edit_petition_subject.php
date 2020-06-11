<?php

if (isset($_POST['edit_petition']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$edit_id = $_POST['edit_id'];
	$petition_subject = $_POST['petition_subject'];
	$status = $_POST['status'];
	$update_petition = query("	UPDATE request_to_open_list
						 		set subject_id = '$petition_subject'
						 		, 	status = '$status'
						 		where id = '$edit_id'
						 	");
	
	if ($update_petition) {
		$_SESSION['msg'] = 'Edit Success!';
		$_SESSION['alert'] = 'alert-info';
		header('Location: index.php?menu=petition_list');
		exit;
	}
}
