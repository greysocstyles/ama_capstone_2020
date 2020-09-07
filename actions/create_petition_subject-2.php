<?php

if (isset($_POST['create_petition']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$petition_subject = $_POST['petition_subject'];
	
	$insert_petition = query("insert into request_to_open_list (subject_id) values ('$petition_subject')");
			
	if ($insert_petition) {
		header('Location: index.php?m=pl');
		exit;
	}
			
}
