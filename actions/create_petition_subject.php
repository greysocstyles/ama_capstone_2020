<?php

if (isset($_POST['create_petition_subject'])) {
		$petition_subject = $_POST['petition_subject'];
		$status = $_POST['status'];

		if (empty($petition_subject) or empty($status)) {
			$msg = 'Please fill in all required fields.';
			$alert_class = 'alert-warning';

		} else {
				$insert_petition = query("insert into request_to_open_list (subject_id, status)
										  values ('$petition_subject', '$status')");
				if ($insert_petition){
					$_SESSION['msg'] = 'create success!';
					$_SESSION['alert'] = 'alert-success';
					header('Location: index.php?menu=petition_list');
					exit;
				}
		}
}
