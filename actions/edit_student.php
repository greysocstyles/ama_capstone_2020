<?php

if (isset($_POST['edit_student']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		$edit_id = $_POST['edit_id'];
		$usn = $_POST['usn'];
		$name = $_POST['name'];
		$curriculum = $_POST['curriculum'];

		if (empty($usn) || empty($usn || empty($curriculum))) {
			$msg = 'Please fill in required fields.';
			$alert_class = 'alert-warning';

		} elseif (!preg_match("/^[a-zA-Z\s]{6,50}+$/i", $name)) {
				$msg = 'Invalid name characters';
				$alert_class = 'alert-danger';

		} elseif (!preg_match('/^[1-9][0-9]{0,11}$/', $usn)) {
				 $msg = 'Invalid USN characters.';
				 $alert_class = 'alert-danger';

		} else {
				$update_student = query("update student_list
	    								set usn = '$usn'
	    								,	name = '$name'
	    								,	curriculum_id = '$curriculum'
	    								where id = '$edit_id'");
				if($update_student){
					$_SESSION['msg'] = 'Edit Success!';
					$_SESSION['alert'] = 'alert-info';
					header('Location: index.php?menu=student_list');
					exit;
				}
		}

}
